<?php

namespace App\Http\Controllers\Backend;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FacilityController extends Controller
{
    public function RoomFacility()
    {
        $facilities = Facility::all();

        return view('backend.facilities.index', compact('facilities'));
    }

    public function RoomFacilityCreate()
    {
        return view('backend.facilities.create');
    }

    public function RoomFacilityStore(Request $request)
    {
        $facilities = Facility::all();
        Facility::insert([
            'name' => ucwords($request->name),
        ]);

        $notification = array(
            'message' => 'New facility has been added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('facility.list')->with($notification);
    }

    public function RoomFacilityEdit($id)
    {
        $facility = Facility::findOrFail($id);

        return view('backend.facilities.edit', compact('facility'));
    }

    public function RoomFacilityUpdate(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);
        $facility->name = ucwords($request->name);
        $facility->save();

        $notification = array(
            'message' => 'New facility has been updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('facility.list')->with($notification);
    }

    public function RoomFacilityDelete(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        // Proceed with deleting the team record
        $facility->delete();

        return response()->json(['success' => true, 'message' => "Team facility has been deleted successfully!"]);
    }
}
