@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Admin User</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Admin User</li>
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
              <form action="{{ route('admin.update', $user->id) }}" method="post" class="row g-3">
                @csrf
                @method('PATCH')

                <div class="col-md-6">
                  <label for="name" class="form-label">Admin User Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" autofocus>
                  @error('name')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label">Admin Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}">
                  @error('email')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="phone" class="form-label">Admin Phone</label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                  @error('phone')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="address" class="form-label">Admin Address</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address', $user->phone) }}">
                  @error('address')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="password" class="form-label">Admin Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" >
                  @error('password')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label for="password_confirmation" class="form-label">Password Confirmation</label>
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                  name="password_confirmation" id="password_confirmation">
                </div>

                <div class="col-md-6">
                  <label for="role_id" class="form-label">Role</label>
                  <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                    <option value="" selected disabled>Select Role</option>
                    @foreach ($roles as $role)

                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                      
                    @endforeach
                  </select>

                  @error('role_id')
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
