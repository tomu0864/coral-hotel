@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Booking</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Add Booking</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="container mt-4">
    <div class="main-body">
      <div class="row justify-content-center">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-4">
              <h4 class="mb-5">Room Information</h4>
              <form class="row g-3" action="{{ route('booking.room.list.store') }}" method="post">
                @csrf
                <div class="col-md-4">
                  <label for="room_id" class="form-label">Room Type</label>
                  <select id="room_id" name="room_id" class="form-select" autofocus>
                    <option hidden>Select Room type</option>
                    @foreach ($roomtype as $type)
                    <option value="{{ $type->room->id }}" {{ old('room_id') == $type->room->id ? 'selected' : '' }}>
                      {{ $type->name }}
                    </option>
                    @endforeach
                  </select>
                  @error('room_id')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-md-4">
                  <label for="check_in" class="form-label">Check In</label>
                  <input type="date" name="check_in" class="form-control @error('check_in') is-invalid @enderror" id="check_in" value="{{ old('check_in') }}">
                  @error('check_in')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-md-4">
                  <label for="check_out" class="form-label">Check Out</label>
                  <input type="date" name="check_out" class="form-control  @error('check_out') is-invalid @enderror" id="check_out" value="{{ old('check_out') }}">
                  @error('check_out')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label for="number_of_rooms" class="form-label">Number of Rooms</label>
                  <input type="number" name="number_of_rooms" class="form-control  @error('number_of_rooms') is-invalid @enderror" id="number_of_rooms" value="{{ old('number_of_rooms') }}">

                  <input type="hidden" name="available_room" id="available_room" class="form_control">
                  <div class="mt-2">
                    <label for="">Availability <span class="text-success available_room"></span></label>
                  </div>
                  @error('number_of_rooms')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror

                </div>
                <div class="col-md-4">
                  <label for="number_of_person" class="form-label">Number of Person</label>
                  <input type="number" class="form-control  @error('number_of_person') is-invalid @enderror" name="number_of_person" id="number_of_person" value="{{ old('number_of_person') }}">
                  @error('number_of_person')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
 
                <h4 class="mt-5 mb-5">Customer Information</h4>

                <div class="col-md-4">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                  @error('name')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                  @error('email')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="col-md-4">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="tel" name="phone" class="form-control  @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}">
                  @error('phone')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label for="country" class="form-label">Country</label>
                  <input type="text" name="country" class="form-control  @error('country') is-invalid @enderror" id="country" value="{{ old('country') }}">
                  @error('country')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label for="state" class="form-label">State</label>
                  <input type="text" name="state" class="form-control  @error('state') is-invalid @enderror" id="state" value="{{ old('state') }}">
                  @error('state')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
            
                <div class="col-md-4">
                  <label for="zip_code" class="form-label">Zip Code</label>
                  <input type="text" name="zip_code" class="form-control  @error('zip_code') is-invalid @enderror" id="zip_code" value="{{ old('zip_code') }}">
                  @error('zip_code')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
            
                <div class="col-md-12">
                  <label for="address" class="form-label">Address</label>
                  <textarea class="form-control  @error('address') is-invalid @enderror" name="address" id="address" rows="3">{{ old('address') }}</textarea>
                  @error('address')
                  <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
    
                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script>
  $(document).ready(function (){
    $('#room_id').on('change', function (){
      $('#check_in').val('');
      $('#check_out').val('');
      $('.availability').text(0);
      $('#available_room').val(0);
    });

    $('#check_out').on('change', function(){
      getAvailability();
    })
  });
  function getAvailability(){
    var check_in = $('#check_in').val();
    var check_out = $('#check_out').val();
    var room_id = $('#room_id').val();

    var startDate = new Date(check_in);
    var endDate   = new Date(check_out);
    var currentDate   = new Date();
    var startOfDayCurrentDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());

    if(startDate >= endDate || startDate < startOfDayCurrentDate) {
      alert('Invalid Date');
      $('#check_out').val('');
      return false;
    }
  
    if(check_in != '' && check_out != '' && room_id != ''){
      $.ajax({
    url: "{{ route('room.availability') }}",
        data: { room_id: room_id, check_in: check_in, check_out: check_out },
        success: function(data){
          $(".available_room").text(data['available_room']);
          $("#available_room").val(data['available_room']);
        }
      });
    }else{
      alert('Field must be not empty');
    }

}


</script>


@endsection