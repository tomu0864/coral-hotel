@extends('frontend.main')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg11">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="{{ route('home') }}">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Team</li>
                  </ul>
                  <h3>Team Member</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Team Style Area -->
      <div class="team-style-area pt-100 pb-70">
          <div class="container">
              <div class="section-title text-center">
                  <span class="sp-color">TEAM</span>
                  <h2>Let's Meet Up With Our Special Team Members</h2>
              </div>
              <div class="row pt-45">
                @foreach ($team as $member)

                <div class="col-lg-4 col-md-6">
                  <div class="team-item">
                      <a href="{{ route('team.list') }}">
                         <img src="{{ $member->image }}" alt="{{ $member->name }}">
                      </a>
                      <div class="content">
                          <h3><a href="{{ route('team.list') }}">{{ $member->name }}</a></h3>
                          <span>{{ $member->position }}</span>
                          <ul class="social-link">
                            <li>
                                <a href="{{ $member->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li> 
                            <li>
                                <a href="{{ $member->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a>
                            </li> 
                            <li>
                                <a href="{{ $member->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a>
                            </li> 
                         </ul>
                      </div>
                  </div>
               </div>
                  
                @endforeach

                  <div class="col-lg-12 col-md-12">
                      <div class="pagination-area">

                        {{ $team->links('vendor.pagination.custom') }}

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Team Style Area End -->

@endsection