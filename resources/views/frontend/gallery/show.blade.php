@extends('frontend.main')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-gallery">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Gallery</li>
                  </ul>
                  <h3>Gallery</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Gallery Area -->
      <div class="gallery-area pt-100 pb-70">
          <div class="container">
              <div class="tab gallery-tab">
                  <ul class="tabs text-center">
                      <li>
                          <a href="#">Hotel Room</a>
                      </li>

                      <li>
                          <a href="#">Hotel Facility</a>
                      </li>

                      <li>
                          <a href="#">restaurant</a>
                      </li>

                  </ul>

                  <div class="tab_content current active pt-45">
                      <div class="tabs_item current">
                          <div class="gallery-tab-item">
                              <div class="gallery-view">
                                  <div class="row">
                                     @foreach ($room_gallery as $item)
                                        
                                      <div class="col-lg-4 col-sm-6">
                                          <div class="single-gallery">
                                              <img src="{{ asset($item->photo) }}" alt="{{ $item->category_name }}">
                                              <a href="{{ asset($item->photo) }}" class="gallery-icon">
                                                  <i class='bx bx-plus'></i>
                                              </a>
                                          </div>
                                      </div>
                                      @endforeach

                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="tabs_item">
                          <div class="gallery-tab-item">
                              <div class="gallery-view">
                                <div class="row">
                                  @foreach ($facility_gallery as $item)
                                     
                                   <div class="col-lg-4 col-sm-6">
                                       <div class="single-gallery">
                                           <img src="{{ asset($item->photo) }}" alt="{{ $item->category_name }}">
                                           <a href="{{ asset($item->photo) }}" class="gallery-icon">
                                               <i class='bx bx-plus'></i>
                                           </a>
                                       </div>
                                   </div>
                                   @endforeach

                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="tabs_item">
                          <div class="gallery-tab-item">
                              <div class="gallery-view">
                                <div class="row">
                                  @foreach ($restaurant_gallery as $item)
                                     
                                   <div class="col-lg-4 col-sm-6">
                                       <div class="single-gallery">
                                           <img src="{{ asset($item->photo) }}" alt="{{ $item->category_name }}">
                                           <a href="{{ asset($item->photo) }}" class="gallery-icon">
                                               <i class='bx bx-plus'></i>
                                           </a>
                                       </div>
                                   </div>
                                   @endforeach

                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Gallery Area End -->

@endsection