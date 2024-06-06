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
          <li class="breadcrumb-item active" aria-current="page">Edit Permission
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
      </div>
    </div>
            <div class="card-body p-4">
              <form action="{{ route('role.permission.update', $permission->id) }}" method="post" class="row g-3">
                @csrf
                @method('PATCH')

                <div class="col-md-6">
                  <label for="name" class="form-label">Permission Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $permission->name) }}" autofocus>
                  <div class="row mt-2" id="preview_img"></div>
                  @error('name')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="group_name" class="form-label">Permission Group</label>
                  <select name="group_name" id="group_name" class="form-control @error('group_name') is-invalid @enderror">
                    <option value="" selected disabled>Select Permission group</option>
                    <option value="Team" {{ $permission->group_name == 'Team' ? 'selected' : '' }}>Team</option>
                    <option value="Testimonial" {{ $permission->group_name == 'Testimonial' ? 'selected' : '' }}>Testimonials</option>
                    <option value="Blog" {{ $permission->group_name == 'Blog' ? 'selected' : '' }}>Blog</option>
                    <option value="Comment" {{ $permission->group_name == 'Comment' ? 'selected' : '' }}>Comment</option>
                    <option value="FAQ" {{ $permission->group_name == 'FAQ' ? 'selected' : '' }}>FAQ</option>
                    <option value="Gallery" {{ $permission->group_name == 'Gallery' ? 'selected' : '' }}>Gallery</option>
                    <option value="Restaurant" {{ $permission->group_name == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                    <option value="Book Area" {{ $permission->group_name == 'Book Area' ? 'selected' : '' }}>Book Area</option>
                    <option value="Facility" {{ $permission->group_name == 'Facility' ? 'selected' : '' }}>Facility</option>
                    <option value="Room Type" {{ $permission->group_name == 'Room Type' ? 'selected' : '' }}>Room Type</option>
                    <option value="Room" {{ $permission->group_name == 'Room' ? 'selected' : '' }}>Room</option>
                    <option value="Booking" {{ $permission->group_name == 'Booking' ? 'selected' : '' }}>Booking</option>
                    <option value="Mail" {{ $permission->group_name == 'Mail' ? 'selected' : '' }}>Mail</option>
                    <option value="Site" {{ $permission->group_name == 'Site' ? 'selected' : '' }}>Site</option>
                    <option value="Privacy Policy" {{ $permission->group_name == 'Privacy Policy' ? 'selected' : '' }}>Privacy Policy</option>
                    <option value="Terms Conditions" {{ $permission->group_name == 'Terms Conditions' ? 'selected' : '' }}>Terms and Conditions</option>
                    <option value="Contact Message" {{ $permission->group_name == 'Contact Message' ? 'selected' : '' }}>Contact Message</option>
                    <option value="Role and Permission" {{ $permission->group_name == 'Role and Permission' ? 'selected' : '' }}>Role and Permission</option>
                  </select>

                  @error('group_name')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

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
</div>

@endsection
