@extends('frontend.main')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg10">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Privacy Policy</li>
                  </ul>
                  <h3>Privacy Policy</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      @php
       $policy = App\Models\PrivacyPolicy::first();
      @endphp
      <!-- Privacy-Policy Area -->
      <div class="privacy-policy-area pt-100 pb-70">
          <div class="container">
              <div class="section-title text-center">
                  <span class="sp-color">Privacy Policy</span>
                  <h2>Atoli Privacy Policy</h2>
                  <p>This Policy Was Last Updated {{ $policy->updated_at ? $policy->updated_at->format('M d,Y') : '' }}.</p>
              </div>
              <div class="row pt-45">
                  <div class="col-lg-12">
                      <div class="single-area-content">
                        <p>{!! $policy->content !!}</p>           
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Privacy-Policy Area End -->

@endsection