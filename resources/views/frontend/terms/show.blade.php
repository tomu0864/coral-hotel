@extends('frontend.main')
@section('main')

    <!-- Inner Banner -->
    <div class="inner-banner inner-terms">
      <div class="container">
        <div class="inner-title">
          <ul>
            <li>
              <a href="{{ route('home') }}">Home</a>
            </li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>Terms & Conditions</li>
          </ul>
          <h3>Terms & Conditions</h3>
        </div>
      </div>
    </div>
    <!-- Inner Banner End -->

    @php
      $terms = App\Models\TermsCondition::first();
    @endphp

    <!-- Terms Conditions Area -->
    <div class="terms-conditions-area pt-100 pb-70">
      <div class="container">
        <div class="section-title text-center">
          <span class="sp-color">Information & Notices</span>
          <h2>Atoli Terms & Conditions</h2>
        </div>
        <div class="row pt-45">
          <div class="col-lg-12">
            <div class="terms-conditions-img">
              <img src="{{ $terms->image }}" alt="Images" />
            </div>

            <div class="single-area-content">
              <p>{!! $terms->content !!}</p>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Terms Conditions Area End -->

@endsection