@extends('frontend.main')
@section('main')

<style>
  .testimonials-item{
    min-height: 400px;
  }
</style>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg4">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="index.html">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Testimonials</li>
                  </ul>
                  <h3>Testimonials</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Testimonials Area Three -->
      <div class="testimonials-area-three pt-100 pb-70">
          <div class="container">
              <div class="section-title text-center">
                  <span class="sp-color">TESTIMONIAL</span>
                  <h2>Our Latest Testimonials and What Our Client Says</h2>
              </div>
              <div class="row align-items-center pt-45">
                  <div class="col-lg-6 col-md-6">
                      <div class="testimonials-img-two">
                          <img src="{{ asset('frontend/assets/img/testimonials/testimonials-img5.jpg') }}" alt="Images">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                      <div class="testimonials-slider-area owl-carousel owl-theme">

                          @foreach ($latest_testimonial as $latest_testi)

                          <div class="testimonials-slider-content">
                            <i class="flaticon-left-quote"></i>
                            <p>
                              {{ $latest_testi->message }}
                            </p>
                            <ul>
                                <li>
                                    <img src="{{ $latest_testi->image }}" alt="Images">
                                    <h3>{{ $latest_testi->name }}</h3>
                                    <span>{{ $latest_testi->city }}</span>
                                </li>
                            </ul>
                        </div>

                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Testimonials Area Three End -->

      <!-- Testimonials Inner Area -->
      <div class="testimonials-inner-area pb-70">
          <div class="container">
              <div class="row">
                @foreach ($testimonial as $testi)
                  
                  <div class="col-lg-4 col-md-6">
                      <div class="testimonials-item">
                          <i class="flaticon-left-quote text-color"></i>
                          <p>
                            {{ $testi->message }} 
                          </p>
                          <ul>
                              <li>
                                  <img src="{{ $testi->image }}" alt="{{ $testi->name }}">
                                  <h3>{{ $testi->name }}</h3>
                                  <span>{{ $testi->city }}</span>
                              </li>
                          </ul>
                      </div>
                  </div>
                @endforeach
                <div class="col-lg-12 col-md-12">
                  <div class="pagination-area">

                    {{ $testimonial->links('vendor.pagination.custom') }}

                  </div>
                </div>
              </div>
          </div>
      </div>
      <!-- Testimonials Inner Area End -->

@endsection