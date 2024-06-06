<div class="room-details-review" id="clients-review">
    <h2>Clients Review and Ratings</h2>
  
    @php
        $ratings = App\Models\Rating::where('room_id', $room->id)->latest()->take(3)->get();
        $all_ratings = App\Models\Rating::where('room_id', $room->id)->latest()->get();
    @endphp
  
    <div class="reviews-wrap mt-4" id="updateReview">
      <ul>
        @foreach ($ratings as $rating)
            <li>
                @if (Auth::check() && $rating->user_id == Auth::user()->id)
                    <!-- Show edit input -->
                    <div class="review-rating mt-2">
                       <div class="d-flex align-items-center justify-content-between">
                        <h3>Your ratings:</h3>
                        <form action="{{ route('rating.delete', $rating->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn border-none">
                            <h3 class="text-danger mb-0"><i class='bx bx-trash pt-1'></i> Delete</h3>
                          </button>
                        </form>
                      </div>
  
                        @for ($i = 1; $i <= 5; $i++)
                            <i id="star-{{ $rating->id }}-{{ $i }}" class='{{ $i <= old('rating', $rating->rating) ? "bxs-star" : "bx-star" }} bx star' data-value="{{ $i }}" data-rating-id="{{ $rating->id }}"></i>
                        @endfor
                    </div>
    
                    <form action="{{ route('rating.update', $rating->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    
                                     <input type="hidden" name="rating" id="rating-{{ $rating->id }}" value="{{ old('rating', $rating->rating) }}">
                                      @error('rating')
                                          <p class="text-danger mb-0">{{ $message }}</p>
                                      @enderror
                                    <textarea name="review" class="form-control" cols="30" rows="8" placeholder="Edit your review here...">{{ old('review', $rating->review) }}</textarea>
                                    @error("review")
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-3">
                                <button type="submit" class="default-btn btn-bg-three">
                                   <i class='bx bx-edit fs-5 mt-1'></i> Update Review
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <!-- Show normal content -->
                    <div class="review-rating mb-2">
                        @for ($i = 0; $i < $rating->rating; $i++)
                            <i class='bx bxs-star'></i>
                        @endfor
                    </div>
        
                    <img src="{{ $rating->user->photo ? url('upload/user_images/' . $rating->user->photo) : url('upload/no_image.jpg') }}" alt="{{ $rating->user->name }}" style="height: 50px; width:50px;">
                    <h3>{{ $rating->user->name }}</h3>
                    <span>{{ $rating->created_at->format('M d, Y') }}</span>
                    <p class="white-space-pre">{!! nl2br(e($rating->review)) !!}</p>
                @endif
            </li>
        @endforeach
    </ul>
    
  
        @if ($all_ratings->count() > 3)
            <button type="button" class="btn mt-2 fw-bold" data-bs-toggle="modal" data-bs-target="#reviewsModal" style="color: #ee786c;">
                See All Reviews
            </button>
        @endif
  
  
        @auth
            <div class="review-rating mt-4">
                <h3>Your ratings:</h3>
                <i id="star-1" class='bx bx-star' data-value="1"></i>
                <i id="star-2" class='bx bx-star' data-value="2"></i>
                <i id="star-3" class='bx bx-star' data-value="3"></i>
                <i id="star-4" class='bx bx-star' data-value="4"></i>
                <i id="star-5" class='bx bx-star' data-value="5"></i>
            </div>
  
            <form action="{{ route('rating.store', $room->id) }}" method="post">
                @csrf
                <input type="hidden" name="rating" id="rating" value="">
                @error('rating')
                    <p class="text-danger mb-0">{{ $message }}</p>
                @enderror
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <textarea name="review" class="form-control" cols="30" rows="8" placeholder="Write your review here....">{{ old('review') }}</textarea>
                            @error('review')
                                <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three">
                            Submit Review
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <p>Please <a href="{{ route('login') }}" style="color: #b56952">Login</a> first to add review</p>
                </div>
                <div class="col-lg-12 col-md-12">
                    <button type="button" class="default-btn btn-bg-three" disabled>
                        Submit Review
                    </button>
                </div>
            </div>
        @endauth
    </div>
  </div>
  @include('frontend.room.modals.rating')

<script>
  
  document.addEventListener('DOMContentLoaded', function () {
    const ratingInput = document.getElementById('rating');
    const stars = document.querySelectorAll('.review-rating .bx-star');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const selectedRating = parseInt(star.getAttribute('data-value'));
            ratingInput.value = selectedRating;
            updateStarDisplay(selectedRating);
        });
    });

    function updateStarDisplay(rating) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= rating) {
                star.classList.remove('bx-star');
                star.classList.add('bxs-star');
            } else {
                star.classList.remove('bxs-star');
                star.classList.add('bx-star');
            }
        });
    }
});
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const updateReviewForm = document.getElementById('updateReview'); // Get the form for updating reviews
    const stars = updateReviewForm.querySelectorAll('.star'); // Get all star elements within the update review form

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = parseInt(this.getAttribute('data-value'));
            const ratingId = this.getAttribute('data-rating-id');

            // Toggle the star classes
            stars.forEach(s => {
                const starRatingId = s.getAttribute('data-rating-id');
                const starValue = parseInt(s.getAttribute('data-value'));
                
                if (starRatingId === ratingId) {
                    if (starValue <= value) {
                        s.classList.remove('bx-star');
                        s.classList.add('bxs-star');
                    } else {
                        s.classList.remove('bxs-star');
                        s.classList.add('bx-star');
                    }
                }
            });

            // Update the rating input value using the rating ID
            const ratingInput = updateReviewForm.querySelector(`#rating-${ratingId}`);
            if (ratingInput) {
                ratingInput.value = value;
            }
        });
    });

    // Function to handle the update review button click
    const updateReviewButtons = updateReviewForm.querySelectorAll('.update-review-button');
    updateReviewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const ratingId = this.getAttribute('data-rating-id');
            const reviewTextarea = updateReviewForm.querySelector(`textarea[name="review${ratingId}"]`);
            const currentReview = reviewTextarea.value.trim(); // Get the current review text

            // Set the current review text as the initial value in the review textarea
            reviewTextarea.value = currentReview;
        });
    });
});


  
  
  </script>

