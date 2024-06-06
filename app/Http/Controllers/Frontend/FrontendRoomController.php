<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MultiImage;
use App\Models\RoomBookedDate;
use App\Models\RoomFacility;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Session;

class FrontendRoomController extends Controller
{
    public function RoomList()
    {
        $rooms = Room::latest()->get();

        return view('frontend.room.all_rooms', compact('rooms'));
    }

    public function RoomDetails($id)
    {
        $room = Room::findOrFail($id);
        $multiImgs = MultiImage::where('rooms_id', $id)->get();
        $facilities = RoomFacility::where('rooms_id', $id)->get();
        $otherRooms = Room::where('id', '!=', $id)->orderBy('id', 'DESC')->take(2)->get();

        return view('frontend.room.room_details', compact('room', 'multiImgs', 'facilities', 'otherRooms'));
    }

    public function BookingSearch(Request $request)
    {
        // Store all the input data into the session
        $request->flash();

        // Date request manupulation

        if ($request->check_in >= $request->check_out) {
            $notification = array(
                'message' => "Check-out date must be after check-in date",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $allDate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $allDate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)
            ->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('room_numbers')->where('status', '1')->get();

        return view('frontend.room.search_room', compact('rooms', 'check_date_booking_ids'));
    }

    public function BookingSearchDetails($id)
    {
        $room = Room::findOrFail($id);

        // Retrieve old session data (if needed)
        $checkIn = old('check_in') ?? Session::get('check_in');
        $checkOut = old('check_out') ?? Session::get('check_out');
        $person = old('person') ?? Session::get('person');

        // Store old form input in session
        Session::put('check_in', $checkIn);
        Session::put('check_out', $checkOut);
        Session::put('person', $person);

        // Retrieve additional data as needed (multi images, facilities, other rooms, etc.)
        $multiImgs = MultiImage::where('rooms_id', $id)->get();
        $facilities = RoomFacility::where('rooms_id', $id)->get();
        $otherRooms = Room::where('id', '!=', $id)->orderBy('id', 'DESC')->take(2)->get();

        return view(
            'frontend.room.search_room_details',
            compact('room', 'multiImgs', 'facilities', 'otherRooms', 'checkIn', 'checkOut', 'person')
        );
    }

    public function CheckAvailability(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $allDate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $allDate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)
            ->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_numbers')->findOrFail($request->room_id);

        $bookings = Booking::withCount('assign_rooms')
            ->whereIn('id', $check_date_booking_ids)->where('room_id', $room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));

        $av_room = @$room->room_numbers_count - $total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room' => $av_room, 'total_nights' => $nights]);
    }
}
