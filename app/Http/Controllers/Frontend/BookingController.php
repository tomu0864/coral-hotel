<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use App\Mail\BookConfirm;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Models\BookingRoomList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Mail\PaymentConfirm;
use App\Notifications\BookingComplete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use PragmaRX\Countries\Package\Countries;

class BookingController extends Controller
{
    // FRONTEND
    public function Checkout()
    {
        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $room = Room::findOrFail($book_data['room_id']);

            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);
            // Installed pragmarx
            $countries = Countries::all()->pluck('name.common')->toArray();

            return view('frontend.checkout.checkout', compact('book_data', 'room', 'nights', 'countries'));
        } else {

            $notification = array(
                'message' => "Something went wrong!",
                'alert-type' => 'error'
            );

            return redirect('/')->back()->with($notification);
        }
    }

    public function BookingStore(Request $request)
    {

        // Security Purpose(client and server side validation)
        $validate = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'person' => 'required',
            'number_of_rooms' => 'required',
        ]);

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => "Sorry, you have selected more rooms than available",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($request->check_in >= $request->check_out) {

            $notification = array(
                'message' => "Check-out date must be after check-in date",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($request->person > $request->total_adult) {

            $notification = array(
                'message' => "Sorry, you have selected more persons than allowed",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // End of validation

        Session::forget('book_date');
        Session::forget('check_in');
        Session::forget('check_out');
        Session::forget('person');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room']  = $request->available_room;
        $data['person']          = $request->person;
        $data['check_in']        = date('Y-m-d', strtotime($request->check_in));
        $data['check_out']       = date('Y-m-d', strtotime($request->check_out));
        $data['room_id']         = $request->room_id;

        Session::put('book_date', $data);

        return redirect()->route('booking.checkout');
    }

    public function CheckoutStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'address' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);


        $book_data = Session::get('book_date');
        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $room = Room::findOrFail($book_data['room_id']);
        $basic_price = $room->price * $total_nights * $book_data['number_of_rooms'];
        $discount = ($room->discount / 100) * $basic_price;
        $total_price = $basic_price - $discount;
        $code = rand(000000000, 999999999);

        if ($request->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = Charge::create([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source"   => $request->stripeToken,
                "description" => "Payment for Booking. Booking No." . $code,
            ]);

            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transaction_id = $s_pay->id;
            } else {
                $notification = array(
                    'message' => "Sorry, Payment process failed!",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            $payment_status = 0;
            $transaction_id = '';
        }

        // Booking Table
        $data = new Booking();
        $data->room_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $data->person = $book_data['person'];
        $data->total_night = $total_nights;
        $data->number_of_rooms = $book_data['number_of_rooms'];
        $data->actual_price = $room->price;
        $data->sub_total = $basic_price;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = $request->payment_method;
        $data->transaction_id = $transaction_id;
        $data->payment_status = $payment_status;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;
        $data->address = $request->address;
        $data->code = $code;
        $data->status = 1;
        $data->created_at = Carbon::now();

        $data->save();


        // Room_book_dates Table
        $sDate = date('Y-m-d', strtotime($book_data['check_in']));
        $eDate = date('Y-m-d', strtotime($book_data['check_out']));
        $allDate = Carbon::create($eDate)->subDay();
        $d_period = CarbonPeriod::create($sDate, $allDate);

        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate;
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $room->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        // Booking room list table
        $booking_date_array = RoomBookedDate::where('booking_id', $data->id)
            ->pluck('book_date')->toArray();

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $booking_date_array)
            ->where('room_id', $data->room_id)->distinct()->pluck('booking_id')->toArray();

        $booking_ids = Booking::whereIn('id', $check_date_booking_ids)->pluck('id')->toArray();

        $assign_room_ids = BookingRoomList::whereIn('booking_id', $booking_ids)->pluck('room_number_id')->toArray();

        $room_numbers = RoomNumber::where('rooms_id', $data->room_id)->whereNotIn('id', $assign_room_ids)->where('status', 'Active')->get();

        for ($i = 0; $i < $data->number_of_rooms; $i++) {
            $assign_data = new BookingRoomList();
            $assign_data->booking_id = $data->id;
            $assign_data->room_id = $data->room_id;
            $assign_data->room_number_id = $room_numbers[$i]->id;
            $assign_data->save();
        }

        // Send Email to guest
        if ($data->payment_status == 1) {
            // Send Email
            $data_payment = [
                'booking_no' => $data->code,
                'check_in' => $data->check_in,
                'check_out' => $data->check_out,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'roomtype' => $data->room->type->name,
                'room_price' => $data->room->price,
                'person' => $data->person,
                'number_of_rooms' => $data->number_of_rooms,
                'total_night' => $data->total_night,
                'subtotal' => $data->actual_price,
                'discount' => $data->discount,
                'total_price' => $data->total_price,
                'payment_method' => $data->payment_method,
            ];

            Mail::to($data->email)->send(new PaymentConfirm($data_payment));
        }

        $data_booking = [
            'booking_no' => $data->code,
            'check_in' => $data->check_in,
            'check_out' => $data->check_out,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        ];

        Mail::to($data->email)->send(new BookConfirm($data_booking));
        // End Email

        Session::forget('book_date');

        $notification = array(
            'message' => "Thank you for your booking! We sent comfirmation email",
            'alert-type' => 'success'
        );

        // Send notification
        $user = User::where('role', 'admin')->get();
        Notification::send($user, new BookingComplete($request->name));

        return redirect('/')->with($notification);
    }

    // BACKEND ADMIN
    public function BookingList()
    {
        $bookings = Booking::where('status', '1')->orderBy('id', 'desc')->get();

        return view('backend.booking.list', compact('bookings'));
    }

    public function BookingHistory()
    {
        $history = Booking::where('status', '2')->orderBy('id', 'desc')->get();

        return view('backend.booking.history', compact('history'));
    }

    public function bookingEdit($id)
    {
        $booking = Booking::with('room')->findOrFail($id);

        return view('backend.booking.edit', compact('booking'));
    }

    public function CompletedBookingDetails($id)
    {
        $booking = Booking::with('room')->findOrFail($id);

        return view('backend.booking.completed_details', compact('booking'));
    }

    public function BookingStatusUpdate(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $old_status = $booking->status;
        $old_payment_status = $booking->payment_status;
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;
        $booking->save();

        if ($booking->payment_status == 1 && $old_payment_status == 0) {
            $sendEmail = Booking::findOrFail($id);
            // Send Email
            $data = [
                'booking_no' => $sendEmail->code,
                'check_in' => $sendEmail->check_in,
                'check_out' => $sendEmail->check_out,
                'name' => $sendEmail->name,
                'email' => $sendEmail->email,
                'phone' => $sendEmail->phone,
                'roomtype' => $sendEmail->room->type->name,
                'room_price' => $sendEmail->room->price,
                'person' => $sendEmail->person,
                'number_of_rooms' => $sendEmail->number_of_rooms,
                'total_night' => $sendEmail->total_night,
                'subtotal' => $sendEmail->actual_price,
                'discount' => $sendEmail->discount,
                'total_price' => $sendEmail->total_price,
                'payment_method' => $sendEmail->payment_method,
            ];

            Mail::to($sendEmail->email)->send(new PaymentConfirm($data));
            // End Email
        }

        if ($booking->status == 2 && $old_status == 1) {
            $sendEmail = Booking::findOrFail($id);
            // Send Email
            $data = [
                'booking_no' => $sendEmail->code,
                'check_in' => $sendEmail->check_in,
                'check_out' => $sendEmail->check_out,
                'name' => $sendEmail->name,
                'email' => $sendEmail->email,
                'phone' => $sendEmail->phone,

            ];

            Mail::to($sendEmail->email)->send(new BookConfirm($data));
            // End Email

            $notification = array(
                'message' => "Booking has been Completed!",
                'alert-type' => 'success'
            );

            return redirect()->route('booking.history')->with($notification);
        }

        $notification = array(
            'message' => "Booking information has been updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BookingCompleteStatusUpdate(Request $request, $id)
    {

        $booking = Booking::findOrFail($id);
        $old_payment_status = $booking->payment_status;
        $booking->payment_status = $request->payment_status;
        $booking->save();

        if ($booking->payment_status == 1 && $old_payment_status == 0) {
            $sendEmail = Booking::findOrFail($id);
            // Send Email
            $data = [
                'booking_no' => $sendEmail->code,
                'check_in' => $sendEmail->check_in,
                'check_out' => $sendEmail->check_out,
                'name' => $sendEmail->name,
                'email' => $sendEmail->email,
                'phone' => $sendEmail->phone,
                'roomtype' => $sendEmail->room->type->name,
                'room_price' => $sendEmail->room->price,
                'person' => $sendEmail->person,
                'number_of_rooms' => $sendEmail->number_of_rooms,
                'total_night' => $sendEmail->total_night,
                'subtotal' => $sendEmail->actual_price,
                'discount' => $sendEmail->discount,
                'total_price' => $sendEmail->total_price,
                'payment_method' => $sendEmail->payment_method,
            ];

            Mail::to($sendEmail->email)->send(new PaymentConfirm($data));
            // End Email
        }

        $notification = array(
            'message' => "Payment status has been updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BookingUpdate(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'number_of_rooms' => 'required|numeric',
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->number_of_rooms < $request->number_of_rooms) {
            if ($request->available_room < $request->number_of_rooms) {
                $notification = array(
                    'message' => "you have selected more rooms than available",
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }

        if ($request->check_in >= $request->check_out) {
            $notification = array(
                'message' => "Check-out date must be after check-in date",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $today_date = Carbon::today();
        $format_date = $today_date->format('Y-m-d');

        if ($format_date > $request->check_in) {
            $notification = array(
                'message' => "Check-in date must be $format_date or after!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $booking->number_of_rooms = $request->number_of_rooms;
        $booking->check_in = date('Y-m-d', strtotime($request->check_in));
        $booking->check_out = date('Y-m-d', strtotime($request->check_out));

        // Update total night
        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);
        $booking->total_night = $nights;
        $basic_price = ($booking->actual_price * $nights) * $booking->number_of_rooms;
        $booking->sub_total = $basic_price;
        $discount = ($booking->room->discount / 100) * $basic_price;
        $booking->discount = $discount;
        $booking->total_price = $basic_price - $discount;
        $booking->save();

        BookingRoomList::where('booking_id', $id)->delete();
        RoomBookedDate::where('booking_id', $id)->delete();

        // Room_book_dates Table
        $sDate = date('Y-m-d', strtotime($request->check_in));
        $eDate = date('Y-m-d', strtotime($request->check_out));
        $allDate = Carbon::create($eDate)->subDay();
        $d_period = CarbonPeriod::create($sDate, $allDate);

        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate;
            $booked_dates->booking_id = $id;
            $booked_dates->room_id = $booking->room_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        $notification = array(
            'message' => "Booking has been updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Calculate all available room number to be assigned
    public function BookingAssignRoom($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        $booking_date_array = RoomBookedDate::where('booking_id', $booking_id)
            ->pluck('book_date')->toArray();

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $booking_date_array)
            ->where('room_id', $booking->room_id)->distinct()->pluck('booking_id')->toArray();

        $booking_ids = Booking::whereIn('id', $check_date_booking_ids)->pluck('id')->toArray();

        $assign_room_ids = BookingRoomList::whereIn('booking_id', $booking_ids)->pluck('room_number_id')->toArray();

        $room_numbers = RoomNumber::where('rooms_id', $booking->room_id)->whereNotIn('id', $assign_room_ids)->where('status', 'Active')->get();

        return view('backend.booking.assign_room', compact('booking', 'room_numbers'));
    }

    public function  BookingAssignRoomStore($booking_id, $room_number_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $check_data = BookingRoomList::where('booking_id', $booking_id)->count();

        if ($check_data < $booking->number_of_rooms) {
            $assign_data = new BookingRoomList();
            $assign_data->booking_id = $booking_id;
            $assign_data->room_id = $booking->room_id;
            $assign_data->room_number_id = $room_number_id;
            $assign_data->save();

            $notification = array(
                'message' => "Room has been assinged successfully!",
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => "This customer's room has already been assigned",
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function BookingAssignRoomDelete(Request $request, $id)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $assign_room = BookingRoomList::findOrFail($id);
        $assign_room->delete();

        return response()->json(['success' => true]);
    }

    public function DownloadInvoice($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        $pdf = Pdf::loadView('backend.booking.invoice', compact('booking'))
            ->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download("invoice.pdf($booking->code)");
    }

    public function BookingDelete(Request $request, $id)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        Booking::findOrFail($id)->delete();
        RoomBookedDate::where('booking_id', $id)->delete();
        BookingRoomList::where('booking_id', $id)->delete();

        return response()->json(['success' => true, 'message' => "The Booking has been deleted successfully!"]);
    }
    // Cancel booking from user
    public function BookingCancel($id)
    {

        Booking::findOrFail($id)->delete();
        RoomBookedDate::where('booking_id', $id)->delete();
        BookingRoomList::where('booking_id', $id)->delete();

        $notification = array(
            'message' => "Your booking has been canceled successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BookingNow()
    {
        return view('backend.booking.booking_now');
    }

    // Notification

    public function ReadNotification(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }
}
