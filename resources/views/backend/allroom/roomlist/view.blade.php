@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Booking Room List</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Room List</li>
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
  <h6 class="mb-0 text-uppercase">Room No. {{ $room_number->room_no }}</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Booking No.</th>
              <th>In/OUt Date</th>
              <th>Customer</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($room_number_list as $key => $item)
                
            <tr class="align-middle">

            <td>{{ $key+1 }}</td>
              <td>
                @if ($item->booking_id != '')
                <a href="{{ route('booking.edit', $item->booking_id )}}">
                  {{ $item->booking_no }}
                </a> 
                @endif
              </td>

              <td class="text-center">
                @if($item->booking_id != '')
                <span class="badge rounded-pill bg-secondary">
                  {{ date('Y-m-d', strtotime($item->check_in)) }}
                </span>
                    to
                <span class="badge rounded-pill bg-info text-dark">
                   {{ date('Y-m-d', strtotime($item->check_out)) }}
                @endif
              </td>
              <td>
                @if ($item->booking_id != '')
                {{ $item->customer_name }}
                @endif
              </td>
            </tr>
            @endforeach
     
          </tbody>
         
        </table>
      </div>
    </div>
  </div>
 
  {{-- <hr/> --}}

</div>

@endsection