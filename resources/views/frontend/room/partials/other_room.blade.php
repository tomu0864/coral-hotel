<div class="row ">
  @foreach ($otherRooms as $otherRoom)
  <div class="col-lg-6">
      <div class="room-card-two">
          <div class="row align-items-center">
              <div class="col-lg-5 col-md-4 p-0">
                  <div class="room-card-img">
                      <a href="{{ route('room.details', $otherRoom->id) }}">
                          <img src="{{ asset('upload/rooming/' .$otherRoom->image) }}" alt="{{ $otherRoom->type->name }}">
                      </a>
                  </div>
              </div>

              <div class="col-lg-7 col-md-8 p-0">
                  <div class="room-card-content">
                       <h3>
                           <a href="{{ route('room.details', $otherRoom->id) }}">{{ $otherRoom->type->name }}</a>
                      </h3>
                      <div class="d-flex justify-content-between">
                        
                      <span>${{ $otherRoom->price }} / Per Night </span>
                        <span class="">

                           @for ($i = 0; $i < $otherRoom->averageRating(); $i++ )
                             <i class='bx bxs-star'></i>
                           @endfor
                           
                        </span>
                     </div>

                      <p>{{ $otherRoom->short_desc }}</p>
                      <ul>
                          <li><i class='bx bx-user'></i> {{ $otherRoom->capacity }} Person</li>
                          <li><i class='bx bx-expand'></i> {{ $otherRoom->size }}</li>
                      </ul>

                      <ul>
                          <li><i class='bx bx-show-alt'></i> {{ $otherRoom->view }}</li>
                          <li><i class='bx bxs-hotel'></i> {{ $otherRoom->bed_style }}</li>
                      </ul>
                      
                      <a href="{{ route('room.details', $otherRoom->id) }}" class="book-more-btn">
                          Book Now
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>  
  @endforeach
</div>