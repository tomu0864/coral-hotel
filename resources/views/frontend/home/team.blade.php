@php
    $team = App\Models\Team::latest()->get();
@endphp

<div class="team-area-three pt-100 pb-70">
  <div class="container">
      <div class="section-title text-center">
          <span class="sp-color">TEAM</span>
          <h2>Let's Meet Up With Our Special Team Members</h2>
      </div>
      <div class="team-slider-two owl-carousel owl-theme pt-45">

        @foreach ($team as $member)
        <div class="team-item">
            <a href="{{ route('team.list') }}">
                <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
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
        @endforeach
      </div>
  </div>
</div>