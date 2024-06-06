<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Room;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Models\BookingRoomList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RoomListController extends Controller
{
    public function RoomListView($id)
    {
        $room_number_list = RoomNumber::with(
            [
                'room_type', 'booking_list.booking:id,check_in,check_out,status,code,name,phone'
            ]
        )->orderBy('roomtype_id', 'asc')
            ->leftJoin('room_types', 'room_types.id', 'room_numbers.roomtype_id')
            ->leftJoin(
                'booking_room_lists',
                'booking_room_lists.room_number_id',
                'room_numbers.id'
            )
            ->leftJoin('bookings', 'bookings.id', 'booking_room_lists.booking_id')
            ->select(
                'room_numbers.*',
                'room_numbers.id as id',
                'room_types.name',
                'bookings.id as booking_id',
                'bookings.check_in',
                'bookings.check_out',
                'bookings.name as customer_name',
                'bookings.phone as customer_phone',
                'bookings.status as booking_status',
                'bookings.code as booking_no',
            )
            ->where('room_numbers.id', $id)
            ->where('bookings.status', '1')
            ->orderBy('room_types.id', 'asc')
            ->orderBy('bookings.id', 'desc')
            ->get();

        $room_number = RoomNumber::findOrFail($id);

        return view('backend.allroom.roomlist.view', compact('room_number_list', 'room_number'));
    }

    public function RoomListAdd()
    {
        $roomtype = RoomType::all();
        return view('backend.allroom.roomlist.add', compact('roomtype'));
    }

    public function RoomListStore(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'number_of_rooms' => 'required',
            'number_of_person' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'available_room' => 'required',
        ]);

        if ($request->room_id == null) {
            $request->flash();
            $notification = array(
                'message' => "Please select room type",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


        if ($request->check_in >= $request->check_out) {
            $request->flash();
            $notification = array(
                'message' => "Check out date must be after check in date",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($request->available_room > $request->number_of_rooms) {
            $request->flash();
            $notification = array(
                'message' => "you have selected more rooms than available",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $room = Room::findOrFail($request->room_id);

        if ($room->total_adult < $request->number_of_person) {
            $notification = array(
                'message' => "capable geust number is $room->room_capacity for this room",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $total_nights = $toDate->diffInDays($fromDate);

        $basic_price = $room->price * $total_nights * $request->number_of_rooms;
        $discount = ($room->discount / 100) * $basic_price;
        $total_price = $basic_price - $discount;
        $code = rand(000000000, 999999999);

        // Booking Table
        $data = new Booking();
        $data->room_id = $room->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($request->check_in));
        $data->check_out = date('Y-m-d', strtotime($request->check_out));
        $data->person = $request->number_of_rooms;
        $data->total_night = $total_nights;
        $data->number_of_rooms = $request->number_of_rooms;
        $data->actual_price = $room->price;
        $data->sub_total = $basic_price;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = 'COD';
        $data->payment_status = 0;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;
        $data->address = $request->address;
        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();

        $data->save();


        // Room_book_dates Table
        $sDate = date('Y-m-d', strtotime($request->check_in));
        $eDate = date('Y-m-d', strtotime($request->check_out));
        $allDate = Carbon::create($eDate)->subDay();
        $d_period = CarbonPeriod::create($sDate, $allDate);

        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate;
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $room->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        $notification = array(
            'message' => "Thank you! Booking confirmed successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
