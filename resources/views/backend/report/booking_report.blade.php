@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Report</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Booking Report</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-4">
              <form action="{{ route('booking.report.search.by.date') }}" method="post" class="row g-3">
                @csrf
                
                <div class="col-md-6">
                  <label for="start_date" class="form-label">Start Date</label>
                  <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                         name="start_date" id="start_date" value="{{ old('start_date') }}">
                         @error('start_date')
                           <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>
                
                <div class="col-md-6">
                  <label for="post_title" class="form-label">End Date</label>
                  <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                         name="end_date" id="end_date" value="{{ old('end_date') }}">
                         @error('end_date')
                           <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>
                
                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection