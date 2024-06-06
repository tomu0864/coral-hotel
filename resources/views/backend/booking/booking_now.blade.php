@extends('frontend.main')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg1">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Book</li>
                  </ul>
                  <h3>Book Now</h3>
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

@endsection