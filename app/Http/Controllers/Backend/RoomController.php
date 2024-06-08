<?php

namespace App\Http\Controllers\Backend;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use App\Models\RoomFacility;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $room = Room::findOrFail($id);

        $facility = Facility::all();
        $room_facility = RoomFacility::where('rooms_id', $id)->get();
        $multiImgs = MultiImage::where('rooms_id', $id)->get();
        $all_room_no = RoomNumber::where('rooms_id', $id)->get();

        return view('backend.allroom.rooms.edit_rooms', compact('room', 'facility', 'room_facility', 'multiImgs', 'all_room_no'));
    } //Edit Method

    public function UpdateRoom(Request $request, $id)
    {
        $request->validate([
            'short_desc' => 'max:100'
        ]);

        $room = Room::findOrFail($id);
        // $room->roomType_id = $room->roomType_id;

        $room->total_adult    = $request->total_adult;
        $room->total_adult    = $request->total_adult;
        $room->total_child    = $request->total_child;
        $room->room_capacity  = $request->room_capacity;
        $room->price          = $request->price;
        $room->size           = $request->size;
        $room->view           = $request->view;
        $room->bed_style      = $request->bed_style;
        $room->discount       = $request->discount;
        $room->short_desc     = $request->short_desc;
        $room->description    = $request->description;
        $room->status         = 1;
        $room->save();

        // Room Facility table

        $validFacilitiesSelected = false;

        if ($request->has('facility_name') && is_array($request->facility_name)) {
            foreach ($request->facility_name as $facility_name) {
                // Only consider non-empty and non-default options
                if (!empty($facility_name) && $facility_name !== 'Select Facility') {
                    $validFacilitiesSelected = true;
                    break;
                }
            }
        }

        if (!$validFacilitiesSelected) {
            $notification = [
                'message' => 'Please select at least one valid facility',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        } else {
            RoomFacility::where('rooms_id', $id)->delete();
            $facilities = Count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new RoomFacility();
                $fcount->rooms_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            }
        }
        // End Facility table

        $notification = array(

            'message' => 'Room has been updated succesfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Controller Method (RoomController@test)
    public function mainImageStore(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        if ($request->hasFile('single_image')) {
            $image = Image::make($request->file('single_image'))->resize(550, 850)->encode('data-url');
            $room->image = $image;

            // Update room record with file name or path
            $room->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function subImageStore(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $files = $request->multi_img;
        if ($request->hasFile('multi_img')) {
            $subimage = MultiImage::where('rooms_id', $id)->get()->toArray();
            foreach ($files as $file) {
                $image = Image::make($file)->resize(856, 568)->encode('data-url');

                $subimage = new MultiImage();
                $subimage->rooms_id = $room->id;
                $subimage->multi_img = $image;
                $subimage->save();
            }

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function multiImageDelete($id)
    {
        $deleteImage = MultiImage::where('id', $id)->first();

        $notification = array(
            'message' => 'Image has been deleted',
            'alert-type' => 'success'
        );

        // Delete the record form database

        $deleteImage->delete();

        return redirect()->back()->with($notification);
    }

    // Room Number
    public function RoomNumberStore(Request $request, $id)
    {
        $roomtype = RoomType::findOrFail($request->roomtype_id);
        $room = Room::where('roomtype_id', $request->roomtype_id)->first();
        $roomNumber = RoomNumber::where('roomtype_id', $request->roomtype_id)->get();

        if ($room->room_capacity == $roomNumber->count()) {
            $notification = array(
                'message' => "You can not assign more than the number of rooms $roomtype->name can have.",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $room_number = new RoomNumber;
        $room_number_exist = RoomNumber::where('room_no', $request->room_no)->exists();

        if ($room_number_exist) {
            $notification = array(
                'message' => "Room number $request->room_no has already been assigned",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $room_number->rooms_id = $id;
        $room_number->roomtype_id = $request->roomtype_id;
        $room_number->room_no = $request->room_no;
        $room_number->status = $request->status;
        $room_number->save();

        $notification = array(
            'message' => "$roomtype->name has been assigned to $request->room_no successfully!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function RoomNumberEdit($id)
    {
        $edit_room_no = RoomNumber::findOrFail($id);
        return view('backend.allroom.rooms.edit_room_no', compact('edit_room_no'));
    }

    public function RoomNumberUpdate(Request $request, $id)
    {
        $update_room_no = RoomNumber::findOrFail($id);

        // Check if the requested room number is different from the existing one
        if ($request->room_no != $update_room_no->room_no) {
            // Check if the new room number already exists in the database
            $room_number_exist = RoomNumber::where('room_no', $request->room_no)->exists();
            if ($room_number_exist) {
                $notification = [
                    'message' => "Room number $request->room_no has already been assigned",
                    'alert-type' => 'error'
                ];
                return redirect()->route('room.edit', $update_room_no->rooms_id)->with($notification);
            }
        }

        // Update the room number and status if the new room number is valid or unchanged
        $update_room_no->room_no = $request->room_no;
        $update_room_no->status = $request->status;
        $update_room_no->save();

        $notification = [
            'message' => "$update_room_no->room_no has been updated successfully!",
            'alert-type' => 'success'
        ];

        return redirect()->route('room.edit', $update_room_no->rooms_id)->with($notification);
    }

    public function RoomNumberDelete(Request $request, $id)
    {
        $delete_room_no = RoomNumber::findOrFail($id);

        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        // Proceed with deleting the team record
        $delete_room_no->delete();

        return response()->json(['success' => true, 'message' => "Room number $delete_room_no->room_no has been deleted successfully!"]);
    }

    public function RoomDelete(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        RoomType::where('id', $room->roomtype_id)->delete();
        MultiImage::where('rooms_id', $room->id)->delete();
        RoomFacility::where('rooms_id', $room->id)->delete();
        RoomNumber::where('rooms_id', $room->id)->delete();
        $room->delete();

        return response()->json(['success' => true, 'message' => "The room has been deleted successfully!"]);
    }
}
