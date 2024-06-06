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
          <li class="breadcrumb-item active" aria-current="page">Add Permission</li>
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
              <form action="{{ route('role.permission.store') }}" method="post" class="row g-3">
                @csrf

                <div class="col-md-6">
                  <label for="name" class="form-label">Permission Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" autofocus>
                  <div class="row mt-2" id="preview_img"></div>
                  @error('name')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="group_name" class="form-label">Permission Group</label>
                  <select name="group_name" id="group_name" class="form-control @error('group_name') is-invalid @enderror">
                    <option value="" selected disabled>Select Permission group</option>
                    <option value="Team">Team</option>
                    <option value="Testimonials">Testimonials</option>
                    <option value="Blog">Blog</option>
                    <option value="Comment">Comment</option>
                    <option value="FAQ">FAQ</option>
                    <option value="Gallery">Gallery</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Book Area">Book Area</option>
                    <option value="Facility">Facility</option>
                    <option value="Room Type">Room Type</option>
                    <option value="Room Number">Room Number</option>
                    <option value="Booking">Booking</option>
                    <option value="Room List">Room List</option>
                    <option value="Mail">Mail</option>
                    <option value="Site">Site</option>
                    <option value="Site">Comment</option>
                    <option value="Privacy Policy">Privacy Policy</option>
                    <option value="Terms Conditions">Terms and Conditions</option>
                    <option value="Contact Message">Contact Message</option>
                    <option value="Role And Permission">Role And Permission</option>
                    <option value="Admin User">Admin User</option>
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
