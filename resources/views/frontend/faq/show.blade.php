@extends('frontend.main')
@section('main')

<style>
  .contact-form .text-danger {
      font-size: 14px;
  }
  </style>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg6">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>FAQ</li>
                  </ul>
                  <h3>FAQ</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- FAQ Area -->
      <div class="faq-area pt-100 pb-70 section-bg-2">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-6">
                      <div class="faq-content faq-content-bg2">
                          <div class="section-title">
                              <span class="sp-color">FREE OF QUESTION</span>
                              <h2>Let's Start a Free of Questions and Get a Quick Support</h2>
                              <p>We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch.</p>
                          </div>

                          <div class="faq-accordion">
                              <ul class="accordion">
                                @foreach ($faqs as $faq)

                                  <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class='bx bx-plus'></i>
                                      {{ $faq->question }}
                                    </a>
    
                                    <div class="accordion-content">
                                       <p class="white-space-pre">{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                </li>
                                  
                                @endforeach
  
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="faq-img-3">
                          <img src="{{ asset('frontend/assets/img/faq/faq-img3.jpg') }}" alt="Images">
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- FAQ Area End -->

      <!-- FAQ Another -->
      <div class="faq-another pt-100 pb-70">
          <div class="container">
              <div class="faq-form">
                  <div class="contact-form">
                      <div class="section-title text-center">
                          <h2>Ask Questions</h2>
                      </div>
                      <form  action="{{ route('contact.store') }}" method="post">
                        @csrf
                          <div class="row">
                              <div class="col-lg-6 col-sm-6">
                                  <div class="form-group">
                                      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid
                                      @enderror" value="{{ old('name') }}"  placeholder="Name">
                                      @error('name')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-lg-6 col-sm-6">
                                  <div class="form-group">
                                      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid
                                      @enderror" value="{{ old('email') }}"  placeholder="Email">
                                      @error('email')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-lg-6 col-sm-6">
                                  <div class="form-group">
                                      <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid
                                      @enderror" placeholder="Phone">
                                      @error('phone')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-lg-6 col-sm-6">
                                  <div class="form-group">
                                      <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid
                                      @enderror" value="{{ old('subject') }}"  placeholder="Your Subject">
                                      @error('subject')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                      <textarea name="message" class="form-control @error('message') is-invalid
                                      @enderror" id="message" cols="30" rows="8"  placeholder="Your Message">{{ old('message') }}</textarea>
                                      @error('message')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                              <div class="col-lg-12 col-md-12">
                                  <div class="form-group checkbox-option" style="display: flex; text-align:center">
                                      <input type="checkbox" id="check" name="check">
                                      <p class="ps-2" style="margin-bottom: 0">
                                          Accept <a href="{{ route('terms.show') }}">Terms & Conditions</a> And <a href="{{ route('private.policy.show') }}">Privacy Policy.</a>
                                      </p>
                                  </div>
                                </div>
                                @error('check')
                                <p class="text-danger mt-0">{{ $message }}</p>
                              @enderror

                              <div class="col-lg-12 col-md-12">
                                  <button type="submit" class="default-btn btn-bg-three">
                                      Send Message
                                  </button>
                                  <div id="msgSubmit" class="h3 text-center hidden"></div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- FAQ Another End -->

@endsection