@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Bookings</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Upcoming Bookings</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Upcoming Bookings</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Booking No</th>
              <th>Booking Date</th>
              <th>Customer</th>
              <th>Room</th>
              <th>Check In/Out</th>
              <th>Total Room</th>
              <th>Guest</th>
              <th>Payment</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bookings as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td><a href="{{ route('booking.edit', $item->id )}} ">{{ $item->code }}</a></td>
              <td>{{ $item->created_at->format('d/m/Y') }}</td>
              <td>{{ $item->user->name }}</td>
              <td>{{ $item->room->type->name }}</td>
              <td class="text-center"><span class="badge bg-primary">{{ $item->check_in }}</span> <br>
                <span class="badge bg-warning">{{ $item->check_out }}</span></td>
              <td>{{ $item->number_of_rooms }}</td>
              <td>{{ $item->person }}</td>
              <td class="text-center">
                @if ($item->payment_status == '1')
                <span class="badge bg-success">Completed</span>
                @else
                <span class="badge bg-danger">Pending</span>
                @endif
            </td>
              <td>
                <form action="{{ route('booking.delete', $item->id) }}" id="deleteBooking" method="post" class="d-inline deleteBooking">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold px-3 radius-30">Cancel</button>
              </form>
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