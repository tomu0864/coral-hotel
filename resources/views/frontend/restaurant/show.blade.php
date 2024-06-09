@extends('frontend.main')
@section('main')

 <!-- Inner Banner -->
 <div class="inner-banner inner-bg12">
  <div class="container">
      <div class="inner-title">
          <ul>
              <li>
                  <a href="{{ route('home') }}">Home</a>
              </li>
              <li><i class='bx bx-chevron-right'></i></li>
              <li>Restaurant</li>
          </ul>
          <h3>Restaurant</h3>
      </div>
  </div>
</div>
<!-- Inner Banner End -->

<!-- Gallery Area -->
<div class="gallery-area pt-100">
  <div class="container">
      <div class="tab gallery-tab">
          <ul class="tabs text-center">
            <li>
              <a href="#">All</a>
            </li>

            @foreach ($categories as $category)
              <li>
                  <a href="#">{{ $category->name }}</a>
              </li>
                
            @endforeach
          </ul>

          <div class="tab_content current active pt-45">
              <div class="tabs_item current">
                  <div class="gallery-tab-item">
                      <div class="gallery-view">
                        @foreach ($categories as $category)
                          
                        <div class="section-title text-center">
                          <h2>{{ $category->name }}</h2>
                          <span> {{ $category->time }}</span>
                        </div>

                        <div class="row pt-45 mb-5">

                        @foreach ($category->menus->take(6) as $menu)
                          
                          <div class="col-lg-6">
                              <div class="restaurant-item">
                                  <div class="row align-items-center">
                                      <div class="col-lg-6 col-md-6 p-0">
                                          <div class="restaurant-img">
                                              <img src="{{ $menu->image }}" alt="{{ $menu->name }}">
                                          </div>
                                      </div>
      
                                      <div class="col-lg-6 col-md-6 p-0">
                                          <div class="restaurant-content">
                                              <h3>{{ $menu->name }}</h3>
                                              <p>
                                                 {{ Str::limit($menu->description, 150) }}
                                              </p>
                                              <h4>${{ $menu->price }}</h4>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                           </div>

                        @endforeach
      
                      </div>
                      @endforeach
                  </div>
                 </div>
              </div>

              @foreach ($categories as $category)

              <div class="tabs_item">
                <div class="gallery-tab-item">
                    <div class="gallery-view">

                      <div class="section-title text-center">
                        <h2>{{ $category->name }}</h2>
                        <span>{{ $category->time }}</span>
                      </div>

                      <div class="row pt-45 mb-5">

                        @foreach ($category->menus as $menu)
                          
                          <div class="col-lg-6">
                              <div class="restaurant-item">
                                  <div class="row align-items-center">
                                      <div class="col-lg-6 col-md-6 p-0">
                                          <div class="restaurant-img">
                                              <img src="{{ $menu->image }}" alt="{{ $menu->name }}">
                                          </div>
                                      </div>
      
                                      <div class="col-lg-6 col-md-6 p-0">
                                          <div class="restaurant-content">
                                              <h3>{{ $menu->name }}</h3>
                                              <p>
                                                 {{ Str::limit($menu->description, 150) }}
                                              </p>
                                              <h4>${{ $menu->price }}</h4>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                           </div>
                        @endforeach
      
                      </div>
                    </div>
                </div>
            </div>
              @endforeach           
          </div>
       </div>
</div>
<!-- Gallery Area End -->

@endsection