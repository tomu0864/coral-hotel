@extends('frontend.main')

@section('main')

<style>
  .testimonials-item{
    min-height: 400px;
  }
</style>

   <!-- Inner Banner -->
   <div class="inner-banner inner-bg1">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>About Us</li>
            </ul>
            <h3>About Us</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- About Area -->
<div class="about-area pt-100 pb-70">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="{{ asset('frontend/assets/img/about/about-img3.jpg') }}" alt="Images">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title">
                        <h2>We Have More Than 20+ Global & International Experience</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, 
                            sit amet rhoncus massa aliquam sit amet. Cras porttitor mauris quis mattis ornare.
                            In efficitur at sem quis pretium. Aenean sit amet neque ut dolor lacinia rutrum. 
                            In vulputate pellentesque turpis et porta.
                        </p>
                    </div>

                    <div class="about-form">
                      <form action="{{ route('room.booking.search') }}" method="get">
                          <div class="row align-items-center">
                              <div class="col-lg-4 col-md-4">
                                  <div class="form-group">
                                      <label>Check in</label>
                                      <div class="input-group" >
                                          <input type="text" class="form-control dt_picker" name="check_in" value="{{ old('check_in') }}" 
                                                 autocomplete="off" placeholder="yyyy-mm-dd" required>
                                          <span class="input-group-addon"></span>
                                      </div>
                                      <i class='bx bxs-calendar'></i>
                                  </div>
                              </div>
                              
                              <div class="col-lg-4 col-md-4">
                                  <div class="form-group">
                                      <label>Check Out</label>
                                      <div class="input-group">
                                          <input  type="text" name="check_out" class="form-control dt_picker" value="{{ old('check_out') }}" 
                                                 autocomplete="off" placeholder="yyyy-mm-dd" required>
                                          <span class="input-group-addon"></span>
                                      </div>
                                      <i class='bx bxs-calendar'></i>
                                  </div>
                              </div>

                              <div class="col-lg-4 col-md-4">
                                  <div class="form-group">
                                      <label>Persons</label>
                                      <select name="person"  class="form-control">
                                          <option>01</option>
                                          <option>02</option>
                                          <option>03</option>
                                          <option>04</option>
                                          <option>05</option>
                                      </select>	
                                  </div>
                              </div>
  
  
                              <div class="col-lg-12 col-md-12">
                                  <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                      Check Availability
                                  </button>
                              </div>
                          </div>
                      </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Area End -->

<!-- Choose Area -->
<div class="choose-area pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Why You Choose Our Hotel & Resort Form the All of the Other's</h2>
        </div>
        <div class="row pt-45">
            <div class="col-lg-4 col-md-6">
                <div class="choose-card">
                    <i class="flaticon-restaurant"></i>
                    <h3>Restaurant Facilities</h3>
                    <p>We are one of the best company in the global market and we have restaurant facilities for all of our guide</p>
                    {{-- <a href="#" class="read-btn">Read More</a> --}}
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="choose-card">
                    <i class="flaticon-wifi-signal-1"></i>
                    <h3>Free Wifi Facilities</h3>
                    <p>
                        This is the place where I will get a free wifi zone at a reasonable price and this will
                        help you to make a colorful life
                    </p>
                    {{-- <a href="#" class="read-btn">Read More</a> --}}
                </div>
            </div>

            <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                <div class="choose-card">
                    <i class="flaticon-fireworks"></i>
                    <h3>5 Stars Rattings</h3>
                    <p>
                        Atoli is well known agency and the agency is one of the best by 5-star retting and
                        we will be benefited .
                    </p>
                    {{-- <a href="#" class="read-btn">Read More</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Choose Area End -->

<!-- Ability Area -->
<div class="ability-area section-bg pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="ability-content">
                    <div class="section-title">
                        <h2>Our Ability to the Global and International Market</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, 
                            sit amet rhoncus massa aliquam sit amet. Cras porttitor mauris quis mattis ornare.
                            In efficitur at sem quis pretium. Aenean sit amet neque ut dolor lacinia rutrum. 
                            In vulputate pellentesque turpis et porta.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="ability-counter">
                                <h3 class="text-color">14K</h3>
                                <p>5 Star Retting Reviews</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="ability-counter">
                                <h3 class="text-color">225K</h3>
                                <p>Items Served Breakfast</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ability-img-2">
                    <img src="{{ asset('frontend/assets/img/ability-img2.jpg') }}" alt="Images">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ability Area  End -->

<!-- Specialty Area Two -->
<div class="specialty-area pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="specialty-img-3">
                    <img src="{{ asset('frontend/assets/img/specialty/specialty-img3.jpg') }}" alt="Images">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="specialty-list">
                    <div class="section-title">
                        <h2>Our Specialization Sectors & All of the Other Details</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="specialty-list-card">
                                <i class="text-color flaticon-decoration"></i>
                                <h3>Well Decoration</h3>
                                <p>We are very careful about our room and all of the resort decorations. So, try us.</p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="specialty-list-card">
                                <i class="text-color flaticon-champagne-glass"></i>
                                <h3>Luxury Bar</h3>
                                <p>You can easily enjoy free access to a superstar bar at a reasonable price.</p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="specialty-list-card">
                                <i class="text-color flaticon-fireworks"></i>
                                <h3>5 Stars Rettings</h3>
                                <p>Atoli is a Well Known Agency and the Agency is One of the Best by 5 Star Retting. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Specialty Area Two End -->

<!-- Team Area Two -->
<div class="team-area-two pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Our Special Team Member and Their Details at a Glance</h2>
        </div>
        <div class="row pt-45">
          @foreach ($teams as $team)
            
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <a href="team.html">
                        <img src="{{ $team->image }}" alt="Images">
                    </a>
                    <div class="content">
                        <h3><a href="{{ route('team.list') }}">{{ $team->name }}</a></h3>
                        <span>{{ $team->position }}</span>
                    </div>
                    <ul class="social-link">
                        <li>
                            <a href="{{ $team->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="{{ $team->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li> 
                        <li>
                            <a href="{{ $team->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li>  
                    </ul>
                </div>
            </div>

          @endforeach

        </div>
    </div>
</div>
<!-- Team Area Two End -->

<!-- Testimonials Area Another -->
<div class="testimonials-area-another pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Our Latest Testimonials and What Our Client Says</h2>
        </div>
        <div class="testimonials-slider-three owl-carousel owl-theme pt-45">
          @foreach ($testimonials as $testi)
            
            <div class="testimonials-item">
                <i class="flaticon-left-quote text-color"></i>
                <p>
                    {{ $testi->message }} 
                </p>
                <ul>
                    <li>
                        <img src="{{ $testi->image }}" alt="Images">
                        <h3>{{ $testi->name }}</h3>
                        <span>{{ $testi->city }}</span>
                    </li>
                </ul>
            </div>

          @endforeach

        </div>
    </div>
</div>
<!-- Testimonials Area Another End -->
@endsection