<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomNumber;
use Illuminate\Http\Request;

class RoomNumberController extends Controller
{
    public function Show()
    {
        $room_numbers = RoomNumber::all();

        return view('backend.room_number.show', compact('room_numbers'));
    }
}
