<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    // Permission
    public function AllPermission()
    {
        $permissions = Permission::latest()->get();

        return view('backend.pages.permission.all', compact('permissions'));
    }

    public function AddPermission()
    {
        return view('backend.pages.permission.add');
    }

    public function StorePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:permissions,name,',
            'group_name' => 'required',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => "New Permission has been created successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('role.permission')->with($notification);
    }

    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit', compact('permission'));
    }

    public function UpdatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:permissions,name,' . $id,
            'group_name' => 'required',
        ]);

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => "Permission has been updated successfully!",
            'alert-type' => 'success'
        );

        $permissions = Permission::latest()->get();

        return redirect()->route('role.permission')->with($notification);
    }

    public function DeletePermission(Request $request, $id)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        Permission::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => "Permission has been deleted successfully!"]);
    }

    public function ImportPermission()
    {
        return view('backend.pages.permission.import');
    }

    public function ImportFilePermission(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,csv',
        ]);

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => "Permission has been imported successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('role.permission')->with($notification);
    }

    public function ExportPermission()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    // Role
    public function AllRole()
    {
        $roles = Role::latest()->get();

        return view('backend.pages.role.all', compact('roles'));
    }

    public function AddRole()
    {
        return view('backend.pages.role.add');
    }

    public function StoreRole(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Role::create([
            'name' => ucwords($request->name),
        ]);


        $notification = array(
            'message' => "New role has been created successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('role.all')->with($notification);
    }

    public function EditRole($id)
    {
        $role = Role::findOrFail($id);

        return view('backend.pages.role.edit', compact('role'));
    }

    public function UpdateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Role::findOrFail($id)->update([
            'name' => ucwords($request->name),
        ]);


        $notification = array(
            'message' => "Role has been updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('role.all')->with($notification);
    }

    public function DeleteRole(Request $request, $id)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        Role::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => "Role has been deleted successfully!"]);
    }

    public function AssignRolePermission()
    {
        $roles = Role::latest()->get();
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();

        return view('backend.pages.rolesetup.assign', compact('roles', 'permissions', 'permission_groups'));
    }

    public function AssignRolePermissionStore(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission' => 'required',
        ]);

        $data = array();
        $permissions = $request->permission;

        $role = Role::findOrFail($request->role_id);
        $role_has_perm = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

        if (!(empty($role_has_perm))) {
            $notification = [
                'message' => "Permissions already have been assigned for $role->name.Please update on edit page",
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }


        foreach ($permissions as $permission) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $permission;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => "Permissions have been assigned to $role->name",
            'alert-type' => 'success'
        );

        return redirect()->route('role.permission.assign.all')->with($notification);
    }

    public function AssignRolePermissionAll()
    {

        $roles = Role::all();

        return view('backend.pages.rolesetup.all', compact('roles'));
    }

    public function AssignRolePermissionEdit($id)
    {

        $role = Role::findOrFail($id);
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();

        return view('backend.pages.rolesetup.edit', compact('role', 'permissions', 'permission_groups'));
    }

    public function AssignRolePermissionUpdate(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id'
        ]);

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        // Delete existing permissions for the role
        DB::table('role_has_permissions')->where('role_id', $role->id)->delete();

        // Insert the new permissions
        $data = [];
        foreach ($permissions as $permissionId) {
            $data[] = [
                'role_id' => $role->id,
                'permission_id' => $permissionId
            ];
        }

        DB::table('role_has_permissions')->insert($data);

        $notification = [
            'message' => "Permissions have been updated for $role->name",
            'alert-type' => 'success'
        ];

        return redirect()->route('role.permission.assign.all')->with($notification);
    }

    public function AssignRolePermissionDelete(Request $request, $id)
    {
        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $role = Role::findOrFail($id);

        if (!is_null($role)) {
            $role->delete();
        }

        return response()->json(['success' => true, 'message' => "Role in permission has deleted successfully!"]);
    }
}
