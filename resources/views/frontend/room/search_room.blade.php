@extends('frontend.main')
@section('main')

 <!-- Inner Banner -->
 <div class="inner-banner inner-bg9">
  <div class="container">
      <div class="inner-title">
          <ul>
              <li>
                  <a href="{{ route('home') }}">Home</a>
              </li>
              <li><i class='bx bx-chevron-right'></i></li>
              <li>Rooms</li>
          </ul>
          <h3>Rooms</h3>
      </div>
  </div>
</div>
<!-- Inner Banner End -->

<!-- Room Area -->
<div class="room-area pt-100 pb-70">
  <div class="container">
      <div class="section-title text-center">
          <span class="sp-color">ROOMS</span>
          <h2>Our Rooms & Rates</h2>
      </div>
      <div class="row pt-45">

        @php
          $empty_array = [];
        @endphp

        @foreach ($rooms as $room)

        @php
          // Retrieve count of rooms that are already booked 
          $bookings = App\Models\Booking::withCount('assign_rooms')
                      ->whereIn('id', $check_date_booking_ids)->where('room_id', $room->id)->get()->toArray();

                      $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));

                      $left_room = $room->room_numbers_count - $total_book_room;
        @endphp

        @if ($left_room > 0 && old('person') <= $room->total_adult)
            
        <div class="col-lg-4 col-md-6">
          <div class="room-card">
            <a href="{{ route('room.booking.search.details',$room->id.'&check_in='.old('check_in').'&check_out='.old('check_out').'&person='.old('person'))}}">
                      <img src="{{ $room->image }}" alt="{{ $room->type->name }}" style="width: 550px; height:300px">
                  </a>
                  <div class="content">
                    <div>
                      <div class="rating-all-room text-color">
                        
                        @for ($i = 0; $i < $room->averageRating(); $i++ )
                        <i class='bx bxs-star'></i>
                        @endfor
  
                      </div>
                    </div>
                      <h3>
                        <a href="{{ route('room.booking.search.details', $room->id.'&check_in='. old('check_in') .'&check_out='. old('check_out') .'&person='. old('person')) }}">
                        {{ $room->type->name }}
                      </a>
                    </h3>
                      <ul>
                          <li class="text-color">${{ $room->price }}</li>
                          <li class="text-color">Per Night</li>
                        </ul>
                  </div>
                </div>
              </div>
              @else

               @php
                 array_push($empty_array,$room->id);
               @endphp

              @endif
          @endforeach

          @if(count($rooms) == count($empty_array))
           <h6 class="text-center text-danger">
            Sorry, No Available Rooms Found 
           </h6>
          @endif
      </div>
  </div>
</div>
<!-- Room Area End -->

@endsection