<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function BookingReport()
    {
        return view('backend.report.booking_report');
    }

    public function SerachByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $bookings = Booking::where('check_in', '>=', $start_date)
            ->where('check_out', '<=', $end_date)->get();

        $total_earnings_array = [];

        foreach ($bookings as $booking) {
            $total_earnings_array[] = $booking->total_price;
        }

        $total_earnings = array_sum($total_earnings_array);

        return view(
            'backend.report.booking_search_date',
            compact('bookings', 'start_date', 'end_date', 'total_earnings')
        );
    }
}
