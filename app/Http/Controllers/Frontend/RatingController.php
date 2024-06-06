<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function Store(Request $request, $room_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'max:1000',
        ]);


        Rating::insert([
            'user_id' => Auth::user()->id,
            'room_id' => $room_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Thank you for your ratings!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'max:1000',
        ]);


        Rating::findOrFail($id)->update([

            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        $notification = array(
            'message' => 'your rating has been updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function Delete($id)
    {
        Rating::findOrFail($id)->delete();

        $notification = array(
            'message' => 'your rating has been deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
