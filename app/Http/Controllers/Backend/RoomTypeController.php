<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class RoomTypeController extends Controller
{
    public function RoomTypeList()
    {
        $all_data = RoomType::orderBy('id', 'desc')->get();

        return view('backend.allroom.roomtype.view_roomtype', compact('all_data'));
    }

    public function AddRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }

    public function StoreRoomType(Request $request)
    {
        $roomtype_id = RoomType::insertGetId([
            'name'       => strtoupper($request->name),
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
        ]);

        $notification = array(
            'message' =>  "$request->name has been added successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    }
}
