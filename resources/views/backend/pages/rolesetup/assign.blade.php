@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Role & Permission</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Roles in Permission</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto"></div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-4">
              <form action="{{ route('role.permission.assign.store') }}" method="post" class="row g-3">
                @csrf

                <div class="col-md-6">
                  <label for="role_id" class="form-label">Role Name</label>
                <select class="form-select mb-3" name="role_id" autofocus>
									<option selected disabled>Select Role</option>
									  @foreach ($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
								</select>
                  @error('role_id')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                
                </div>

                 <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="checkAll">
                   <label class="form-check-label" for="checkAll">Permission All</label>
                 </div>

                 <hr>

                @foreach ($permission_groups as $group)
                   
                <div class="row mb-3">
                  <div class="col-3">

                    <div class="form-check">
                      <input class="form-check-input group-checkbox" type="checkbox" data-group-name="{{ $group->group_name }}">
                       <label class="form-check-label">{{ $group->group_name }}</label>
                     </div>

                  </div>
                  <div class="col-9">

                    @php
                      $permissions = App\Models\User::getPermissionByGroupName($group->group_name)
                    @endphp

                    @foreach ($permissions as $permission)
                      
                    
                      <div class="form-check">
                        <input class="form-check-input permission-checkbox" type="checkbox" value="{{ $permission->id }}" name="permission[]" data-group-name="{{ $group->group_name }}" id="permission{{ $permission->id }}">
                        <label class="form-check-label" for="permission{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                      </div>

                    @endforeach

                  </div>


                </div>


                @endforeach

                @error('permission')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                @enderror

                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
  document.getElementById('checkAll').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
      checkbox.checked = this.checked;
    });
  });

  document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
    groupCheckbox.addEventListener('click', function() {
      const groupName = this.dataset.groupName;
      const relatedPermissions = document.querySelectorAll(`.permission-checkbox[data-group-name="${groupName}"]`);
      relatedPermissions.forEach(permissionCheckbox => {
        permissionCheckbox.checked = this.checked;
      });
    });
  });

  document.querySelectorAll('.permission-checkbox').forEach(permissionCheckbox => {
    permissionCheckbox.addEventListener('click', function() {
      const groupName = this.dataset.groupName;
      const relatedPermissions = document.querySelectorAll(`.permission-checkbox[data-group-name="${groupName}"]`);
      const allChecked = Array.from(relatedPermissions).every(checkbox => checkbox.checked);
      const groupCheckbox = document.querySelector(`.group-checkbox[data-group-name="${groupName}"]`);
      groupCheckbox.checked = allChecked;
    });
  });
</script>

@endsection
