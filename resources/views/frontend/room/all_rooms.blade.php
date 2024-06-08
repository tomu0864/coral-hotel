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
        @foreach ($rooms as $room)
          
        <div class="col-lg-4 col-md-6">
          <div class="room-card">
            <a href="{{ route('room.details', $room->id) }}">
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
                      <h3><a href="{{ route('room.details', $room->id) }}">{{ $room->type->name }}</a></h3>
                      <ul>
                          <li class="text-color">${{ $room->price }}</li>
                          <li class="text-color">Per Night</li>
                        </ul>
                  </div>
                </div>
              </div>
          @endforeach
      </div>
  </div>
</div>
<!-- Room Area End -->

@endsection