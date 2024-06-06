@extends('frontend.main')

@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg6">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="index.html">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>User Dashboard </li>
                  </ul>
                  <h3>User Dashboard</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Service Details Area -->
      <div class="service-details-area pt-100 pb-70">
          <div class="container">
              <div class="row">
                <div class="col-lg-3">
                  @include('frontend.dashboard.user_menu')
              </div>


              <div class="col-lg-9">
                <div class="service-article">   
                    <div class="service-article-title">
                        <h2>User Dashboard </h2>
                    </div>

                    @php
                      $bookings = App\Models\Booking::where('user_id', Auth::user()->id)->get();
                      $c_booking = $bookings->count(); 

                      $upcoming_bookings = App\Models\Booking::where('user_id', Auth::user()->id)->where('status', '1')->get();
                      $c_upcoming_booking = $upcoming_bookings->count();

                      $completed_bookings = App\Models\Booking::where('user_id', Auth::user()->id)->where('status', '2')->get();
                      $c_completed_booking = $completed_bookings->count();
                    @endphp

                    <div class="service-article-content">
                      <div class="row">
                        <div class="col-md-4 text-center">
                          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Total Booking</div>
                            <div class="card-body">
                              <h1 class="card-title text-white" style="font-size: 45px;">{{ $c_booking }}</h1>
                            </div>
                          </div>                   
                        </div>

                        <div class="col-md-4 text-center">
                          <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-header">Upcoming Booking </div>
                            <div class="card-body">
                              <h1 class="card-title text-white" style="font-size: 45px;">{{ $c_upcoming_booking }}</h1>
                            </div>
                          </div>                   
                        </div>
                        
                        <div class="col-md-4 text-center">
                          <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">Completed Booking</div>
                            <div class="card-body">
                              <h1 class="card-title text-white" style="font-size: 45px;">{{ $c_completed_booking }}</h1>
                            </div>
                        </div>                   
                      </div>
                    </div>    
                  </div>
                </div>
              </div>
            </div>
         </div>
      </div>
      <!-- Service Details Area End -->

@endsection