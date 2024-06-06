<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function AdminDashboard()
    {

        return view('admin.index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            // Repalace old photo with new one
            unlink(public_path('upload/admin_images/' . $data->photo));
            //Generate date ID and concatenate with original upload file name
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }
        $data->save();

        // Send toastr notification
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminPasswordUpdate(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        //Update The New Password
        $user_id = Auth::id();

        User::where('id', $user_id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    // Admin User Method
    public function AllAdmin()
    {
        $allAdmin = User::where('role', 'admin')->get();

        return view('backend.pages.admin.all', compact('allAdmin'));
    }

    public function AddAdmin()
    {
        $roles = Role::all();
        return view('backend.pages.admin.add', compact('roles'));
    }

    public function StoreAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->password != $request->password_confirmation) {
            $notification = array(
                'message' => 'Password is not matched with comfirmation',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        // Role Table
        if ($request->role_id) {
            DB::table('model_has_roles')->insert([
                'role_id' => $request->role_id,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
            ]);
        }
        $notification = array(
            'message' => 'Admin user has been created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all')->with($notification);
    }

    public function EditAdmin($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.pages.admin.edit', compact('user', 'roles'));
    }

    public function UpdateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);


        if (!Hash::check($request->password, $user->password)) {
            $notification = array(
                'message' => 'Password is not matched',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if ($request->password != $request->password_confirmation) {
            $notification = array(
                'message' => 'Password is not matched with comfirmation',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();

        if ($request->role_id) {
            DB::table('model_has_roles')->insert([
                'role_id' => $request->role_id,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
            ]);
        }
        $notification = array(
            'message' => 'Admin user has been updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all')->with($notification);
    }

    public function DeleteAdmin(Request $request, $id)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $user = User::findOrFail($id);

        if (!is_null($user)) {
            $user->delete();
        }

        return response()->json(['success' => true, 'message' => "Admin has deleted successfully!"]);
    }
}
