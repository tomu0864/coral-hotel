@php
    $rooms = App\Models\Room::latest()->get();
    
    $setting = App\Models\SiteSetting::first();

@endphp

<div class="navbar-area">
  <!-- Menu For Mobile Device -->
  <div class="mobile-nav">
      <a href="{{ url('/') }}" class="logo">
          <img src="{{ $setting->logo }}" class="logo-one" alt="Logo">
          <img src="{{ $setting->logo }}" class="logo-two" alt="Logo">
      </a>
  </div>

  <!-- Menu For Desktop Device -->
  <div class="main-nav">
      <div class="container">
          <nav class="navbar navbar-expand-md navbar-light ">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ $setting->logo }}" class="logo-one" alt="Logo">
                  <img src="{{ $setting->logo }}" class="logo-two" alt="Logo">
              </a>

              <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                  <ul class="navbar-nav m-auto">
                      <li class="nav-item">
                          <a href="{{ url('/') }}" class="nav-link active">
                            Home
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('about.show') }}" class="nav-link">
                              About
                          </a>
                      </li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                            Pages 
                            <i class='bx bx-chevron-down'></i>
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li class="nav-item">
                                <a href="{{ route('booking.now') }}" class="nav-link">
                                    Book
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('team.list') }}" class="nav-link">
                                    Team
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('faq.show') }}" class="nav-link">
                                    FAQ
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('gallery.show') }}" class="nav-link">
                                    Gallery
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('testimonial.list') }}" class="nav-link">
                                    Testimonials
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('terms.show') }}" class="nav-link">
                                    Terms & Conditions
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('private.policy.show') }}" class="nav-link">
                                    Privacy Policy
                                </a>
                            </li>
                        
                        </ul>
                    </li>

                      <li class="nav-item">
                          <a href="{{ route('restaurant.show') }}" class="nav-link">
                              Restaurant
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('gallery.show') }}" class="nav-link">
                              Gallery
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('blog.list') }}" class="nav-link">
                              Blog
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('room.all') }}" class="nav-link">
                              All Rooms
                              <i class='bx bx-chevron-down'></i>
                          </a>
                          <ul class="dropdown-menu">
                            @foreach ($rooms as $room)
                            <li class="nav-item">
                                <a href="{{ route('room.details', $room->id) }}" class="nav-link">
                                    {{ $room->type->name }} 
                                </a>
                            </li>                                
                            @endforeach
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('contact.us') }}" class="nav-link">
                              Contact
                          </a>
                      </li>

                      <li class="nav-item-btn d-none">
                        <a href="{{ route('booking.now') }}" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                      </li>
                  </ul>

                  <div class="nav-btn d-none d-lg-block">
                      <a href="{{ route('booking.now') }}" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                  </div>
              </div>
          </nav>
      </div>
  </div>
</div>


