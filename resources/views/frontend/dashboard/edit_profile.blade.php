@extends('frontend.main')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg6">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="index.html">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>User Profile </li>
                  </ul>
                  <h3>User Profile</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Service Details Area -->
      <div class="service-details-area pt-100 pb-70">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              {{-- Sidebar --}}
              @include('frontend.dashboard.user_menu')
              {{-- End Sidebar --}}
            </div>

            <div class="col-lg-9">
              <div class="service-article">
                <section class="checkout-area pb-70">
                  <div class="container">
                    <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')

                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <div class="billing-details">
                            <h3 class="title">User Profile</h3>
                            <div class="row">
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label for="name">Name <span class="required">*</span></label>
                                  <input type="text" name="name" id="name" value="{{ old('name', $profileData->name) }}" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label for="email">Email <span class="required">*</span></label>
                                  <input type="email" name="email" id="email" value="{{ old('email', $profileData->email) }}" class="form-control">
                                </div>
                              </div>
                    
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label for="address">Address <span class="required">*</span></label>
                                  <input type="text" name="address" id="address" value="{{ old('address', $profileData->address) }}" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                  <label for="phone">Phone <span class="required">*</span></label>
                                  <input type="tel" name="phone" id="phone" value="{{ old('phone', $profileData->phone) }}" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                  <label for="photo">User Profile <span class="required">*</span></label>
                                  <input type="file" name="photo" id="photo" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-6 mb-4">
         
                                  <img id="showPhoto" src="{{ (!empty($profileData->photo)) ?  
                                  $profileData->photo : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80" height="80">
                                
                              </div>
                              <button type="submit" class="btn btn-danger">Save Changes </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>      
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Service Details Area End -->

      <script type="text/javascript">
        // Dispaly uploading photo
        
          $(document).ready(function(){
            $('#photo').change(function(e){
              var reader = new FileReader();
              reader.onload = function(e){
                $('#showPhoto').attr('src',e.target.result);
              }
              reader.readAsDataURL(e.target.files['0']);
            });
          });
        
        </script>

@endsection