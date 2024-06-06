@php
  $setting = App\Models\SiteSetting::first();
@endphp

<header class="top-header top-header-bg">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-3 col-md-2 pr-0">
              <div class="language-list">
                  <select class="language-list-item">
                      <option>English</option>
                      <option>Japanese</option>
                      <option>Deutsch</option>
                      <option>Português</option>
                      <option>Chinese</option>
                  </select>	
              </div>
          </div>

          <div class="col-lg-9 col-md-10">
              <div class="header-right">
                  <ul>
                      <li>
                          <i class='bx bx-home-alt'></i>
                          <a href="{{ route('contact.us') }}">{{ $setting->address }}</a>
                      </li>
                      <li>
                          <i class='bx bx-phone-call'></i>
                          <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                      </li>

                      <li>
                        <i class="bx bx-envelope"></i>
                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                    </li>

                      @auth
                      <li>
                        <i class='bx bx-home-alt'></i>
                        <a href="{{ route('admin.dashboard') }}">DashBoard</a>
                    </li>
                    <li>
                        <i class='bx bxs-log-out'></i>
                        <a href="{{ route('user.logout') }}">Logout</a>
                    </li>
                      @else
                      
                      <li>
                          <i class='bx bxs-log-in'></i>
                          <a href="{{ route('login') }}">Login</a>
                      </li>
                      <li>
                          <i class='bx bxs-user-rectangle'></i>
                          <a href="{{ route('register') }}">Register</a>
                      </li>

                      @endauth
                  </ul>
              </div>
          </div>
      </div>
  </div>
</header>