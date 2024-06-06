@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Bookings</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Room List</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a href="{{ route('booking.room.list.add') }}" class="btn btn-primary px-5 radius-30">
       Add Booking
      </a>
     </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Room List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Room Type</th>
              <th>Room Number</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($room_numbers as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td>{{ $item->room_type->name }}</td>
              <td><a href="{{ route('booking.room.list.view', $item->id) }}">{{ $item->room_no }}</a></td>
              <td class="text-center">
                @if ($item->status == 'Active')
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Out Of Order</span>
                @endif
            </td>
            </tr>
            @endforeach
     
          </tbody>
         
        </table>
      </div>
    </div>
  </div>
  </div>
 
  {{-- <hr/> --}}


@endsection