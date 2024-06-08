<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



class TeamController extends Controller
{
    public function AllTeam()
    {
        $team = Team::latest()->get();

        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam()
    {
        return view('backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $image = Image::make($request->file('image'))->resize(550, 670)->encode('data-url');

        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'image' => $image,
            'created_at' => now(),
        ]);

        $notification = [
            'message' => 'Team Member Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('team.all')->with($notification);
    }

    public function EditTeam($id)
    {
        $team = Team::findOrFail($id);

        return view('backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request)
    {
        $team_id = $request->id;
        $team = Team::findOrFail($team_id);

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(550, 670)->encode('data-url');

            $team->update([
                'name' => $request->name,
                'position' => ucwords($request->position),
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'image' => $image,
                'created_at' => Carbon::now(),
            ]);



            $notification = array(
                'message' => 'Team Member Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('team.all')->with($notification);
        } else {

            $team->update([

                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Team Member Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('team.all')->with($notification);
        }
    }

    public function DeleteTeam(Request $request, $id)
    {
        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['success' => true, 'message' => "Team member $team->name has deleted successfully!"]);
    }

    // Frontend show all team member

    public function TeamList()
    {
        $team = Team::latest()->paginate(6);

        return view('frontend.team.all', compact('team'));
    }
}
