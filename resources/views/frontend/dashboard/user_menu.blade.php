{{-- Get current user data --}}
@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
@endphp

<div class="service-side-bar text-center">
  <div class="services-bar-widget">
      <h2 class="title">User Menu</h2>
      <div class="side-bar-categories">
          <img src="{{ (!empty($profileData->photo)) ? 
          $profileData->photo : url('upload/no_image.jpg') }}" class="rounded mx-auto d-block mb-1" alt="Image" style="width:100px; height:100px;"> 
          <div>
            <b>{{ $profileData->name }}</b><br>
            <b>{{ $profileData->email }}</b>
          </div>
          <br>

          
          <ul> 
                
              <li>
                  <a href="{{ route('dashboard') }}">User Dashboard</a>
              </li>
              <li>
                  <a href="{{ route('user.profile') }}">User Profile </a>
              </li>
              <li>
                  <a href="{{ route('user.change.password') }}">Change Password</a>
              </li>
              <li>
                  <a href="{{ route('user.booking') }}">Booking Details </a>
              </li>
              <li>
                  <a href="{{ route('user.logout') }}">Logout </a>
              </li>
          </ul>
      </div>
  </div>   
</div>