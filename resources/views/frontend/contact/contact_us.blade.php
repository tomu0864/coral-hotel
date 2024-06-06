@extends('frontend.main')
@section('main')

<style>
.contact-form .text-danger {
    font-size: 14px;
}
</style>
           <!-- Inner Banner -->
           <div class="inner-banner inner-bg2">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Contact</li>
                    </ul>
                    <h3>Contact</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Contact Area -->
        <div class="contact-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-content">
                            <div class="section-title">
                                <h2>Let's Start to Give Us a Message and Contact With Us</h2>
                            </div>
                            <div class="contact-img">
                                <img src="{{ asset('frontend/assets/img/contact-us-2.jpg') }}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-form">
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
        </div>
        <!-- Contact Area End -->

        @php

        $setting = App\Models\SiteSetting::first();
        
        @endphp

        <!-- contact Another -->
        <div class="contact-another pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-another-content">
                            <div class="section-title">
                                <h2>Contacts Info</h2>
                                <p>
                                    We are one of the best agency and we can easily make a contract
                                    us anytime on the below details.
                                </p>
                            </div>

                            <div class="contact-item">
                                <ul>
                                    <li>
                                        <i class='bx bx-home-alt'></i>
                                        <div class="content mb-3">
                                            <span>{{ $site->address }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <i class='bx bx-phone-call'></i>
                                        <div class="content">
                                            <span><a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></span>
                                        </div>
                                    </li>
                                    <li>
                                        <i class='bx bx-envelope'></i>
                                        <div class="content">
                                            <span> <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="contact-another-img">
                            <img src="{{ asset('frontend/assets/img/contact/contact-img1.jpg') }}" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact Another End -->

        <!-- Map Area -->
        <div class="map-area">
            <div class="container-fluid m-0 p-0">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83872.91412778101!2d123.90868348025998!3d10.276148523126498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a999fed973c41b%3A0x1ae9af03b1a02e2c!2sLapu-Lapu%20City%2C%20Cebu%2C%20Philippines!5e0!3m2!1sen!2sjp!4v1716219822926!5m2!1sen!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- Map Area End -->
@endsection