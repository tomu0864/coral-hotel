<!-- Modal -->
<div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="reviewsModalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="title mb-0">Reviews</h3>
        <button type="button" class="btn-close mb-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mt-4">
        <div class="room-details-review">
          <div class="reviews-wrap mt-4">
            <ul>
              @foreach ($ratings as $rating)
                @if (Auth::check() && $rating->user_id == Auth::user()->id)
                  <div class="review-rating mt-4">
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
                      <i id="star-{{ $i }}" class='{{ $i <= old('rating', $rating->rating) ? "bxs-star" : "bx-star" }} bx star' data-value="{{ $i }}" data-rating-id="{{ $rating->id }}"></i>
                    @endfor
                  </div>

                  <form action="{{ route('rating.update', $rating->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="rating" id="rating-{{ $rating->id }}" value="{{ old('rating', $rating->rating) }}">
                    @error('rating')
                      <p class="text-danger mb-0">{{ $message }}</p>
                    @enderror

                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                          <textarea name="review" class="form-control" cols="30" rows="8" placeholder="Write your review here...">{{ old('review', $rating->review) }}</textarea>
                          @error('review')
                            <p class="text-danger mb-0">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 mt-3 mb-4">
                        <button type="submit" class="default-btn btn-bg-three mb-3">
                          <i class='bx bx-edit fs-5 mt-1'></i> Update Review
                        </button>
                      </div>
                    </div>
                  </form>
                @else
                  <li>
                    <div class="review-rating mb-2">
                      @for ($i = 0; $i < $rating->rating; $i++)
                        <i class='bx bxs-star'></i>
                      @endfor
                    </div>
                    <img src="{{ $rating->user->photo ?  url('upload/user_images/' .$rating->user->photo) : url('upload/no_image.jpg') }}"  alt="{{ $rating->user->name }}" style="height: 50px; width:50px;">
                    <h3>{{ $rating->user->name }}</h3>
                    <span> {{ $rating->created_at->format('M d, Y') }}</span>
                    <p>
                      <p class="white-space-pre">{!! nl2br(e($rating->review)) !!}</p>
                    </p>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('reviewsModal');
    const stars = modal.querySelectorAll('.star');

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
            const ratingInput = modal.querySelector(`#rating-${ratingId}`);
            if (ratingInput) {
                ratingInput.value = value;
            }
        });
    });
});
</script>
