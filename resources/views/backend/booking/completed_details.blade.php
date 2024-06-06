@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  
<div class="page-content">
  {{-- Navigaiton --}}
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Booking Details</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Completed Booking Details</li>
        </ol>
      </nav>
    </div>
  </div>

  {{-- Booking basic info --}}
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-5">
    <div class="col">
     <div class="card radius-10 border-start border-0 border-4 border-info">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">Booking No.</p>
            <h6 class="my-1 text-info">{{ $booking->code }}</h6>
          </div>
          <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-book-content'></i>
          </div>
        </div>
      </div>
     </div>
     </div>
     <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-danger">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Booking Date</p>
             <h6 class="my-1 text-danger">{{ $booking->created_at->format('Y/m/d') }}</h6>
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-calendar'></i>
           </div>
         </div>
       </div>
    </div>
    </div>
    <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-success">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Payment Method</p>
             <h6 class="my-1 text-success">{{ $booking->payment_method }}</h6>
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-wallet'></i>
           </div>
         </div>
       </div>
    </div>
    </div>
    <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-warning">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Payment Status</p>
             <h6 class="my-1 text-warning">
              @if ($booking->payment_status == '1')
              <span class="text-success">Paid</span>
              @else
              <span class="text-danger">Pending</span>
              @endif
             </h6>
            
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-kyoto text-white ms-auto"><i class='bx bxs-bar-chart-alt-2'></i>
           </div>
         </div>
       </div>
    </div>
    </div> 
    <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-warning">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Booking Status</p>
             <h6 class="my-1 text-warning">
              @if ($booking->status == '1')
              <span class="text-danger">Booked</span>
              @else
              <span class="text-success">Complete</span>
              @endif
             </h6>
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-bar-chart-square'></i>
           </div>
         </div>
       </div>
    </div>
    </div> 
  </div><!--end row-->

  {{-- Booking details Table --}}
  <div class="row">
    <div class="col-12 col-lg-8 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Room Type</th>
                  <th>Total Room</th>
                  <th>Room Price</th>
                  <th>Check In / Out Date</th>
                  <th>Total Days</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $booking->room->type->name }}</td>
                  <td>{{ $booking->number_of_rooms }}</td>
                  <td>$ {{ number_format($booking->room->price, 2) }}</td>
                  <td><span class="badge bg-primary">{{ $booking->check_in }}</span> <br>
                    <span class="badge bg-warning">{{ $booking->check_out }}</span></td>
                  <td>{{ $booking->total_night }}</td>
                  <td>${{ number_format($booking->total_price, 2) }}</td>
                </tr>
              </tbody>
            </table>
            <div class="col-md-6 float-end">
              <table class="table table-bordered float-end text-end">
                <tr>
                  <td class="fw-bold">Basic price</td>
                  <td >${{ number_format($booking->sub_total, 2) }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Discount</td>
                  <td >${{ number_format($booking->discount, 2) }}</td>
                </tr>
                <tr>
                  <td class="fw-bold">Grand total</td>
                  <td>${{ number_format($booking->total_price, 2) }}</td>
                </tr>
              </table>
            </div>
          </div>

          <div style="clear: both">

            @php
            $assign_rooms = App\Models\BookingRoomList::with('room_number')->where('booking_id', $booking->id)->get();  
            $c_assignable_room = $booking->number_of_rooms - count($assign_rooms); 
            @endphp
          
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th>Room Number</th>
              </tr>
            </thead>

              <tbody>
              @foreach ($assign_rooms as $assign_room)
                <tr>
                  <td>{{ $assign_room->room_number->room_no }}</td>
                </tr>
              @endforeach
           </tbody>
          </table>

          </div>
          {{-- End Table responsive --}}

          <form action="{{ route('booking.complete.status.update', $booking->id ) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="row mt-3">
              <div class="col-md-5">
                <label for="payment_status" class="form-label">Payment status</label>
                <select name="payment_status" id="payment_status" class="form-select">
                  <option hidden>Select Status</option>
                   <option value="0" {{ $booking->payment_status == '0' ? 'selected' : ''}}>
                    Pending
                  </option>
                   <option value="1" {{ $booking->payment_status == '1' ? 'selected' : ''}}>
                    Complete
                  </option>
                </select>
              </div>

              <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
                <a href="{{ route('booking.download.invoice', $booking->id) }}" class="btn btn-warning px-3 radius-10 ms-1">
                  <i class='bx bx-download'></i> Download Invoice
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
     </div>
     
     <div class="col-12 col-lg-4">

       <div class="card radius-10 w-100">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Customer Information</h6>
            </div>
          </div>
        </div>
           <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Name <span class="span badge  bg-primary rounded-pill">{{ $booking->user->name }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Email <span class="span badge bg-primary rounded-pill"> {{ $booking->email }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Phone <span class="span badge bg-primary rounded-pill">{{ $booking->phone }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Country <span class="span badge bg-primary rounded-pill">{{ $booking->country }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                State <span class="span badge bg-primary rounded-pill">{{ $booking->state }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Zip Code <span class="span badge bg-primary rounded-pill">{{ $booking->zip_code }}</span>
              </li>
              <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                Address <span class="span badge bg-primary rounded-pill">{{ $booking->address }}</span>
              </li>
            </ul>
           </div>
       </div>
     </div>
  </div><!--end card-->
</div>

{{-- Modal --}}
<div class="modal fade myModal" id="roomAssingnModal" tabindex="-1" aria-labelledby="roomAssingnLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roomAssingnModalLabel">Rooms</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
{{-- Modal --}}

{{-- Get Available room's number and display modal --}}
<script>
  $(document).ready(function(){
    getAvailability();

    $('.assign_room').on('click', function(){
      $.ajax({
        url: "{{ route('booking.assign.room', $booking->id) }}",
        success: function(data){
          $('.myModal .modal-body').html(data);
          $('.myModal').modal('show');
        }
      });
      return false;
    })
  })
</script>


<script>
  $(document).ready(function (){
    getAvailability();
  });
  function getAvailability(){
    var check_in = $('#check_in').val();
    var check_out = $('#check_out').val();
    var room_id = "{{ $booking->room_id }}";
  
  $.ajax({
    url: "{{ route('room.availability') }}",
        data: { room_id: room_id, check_in: check_in, check_out: check_out },
        success: function(data){
          $(".available_room").text(data['available_room']);
          $("#available_room").val(data['available_room']);
        }
  });
}


</script>

@endsection

