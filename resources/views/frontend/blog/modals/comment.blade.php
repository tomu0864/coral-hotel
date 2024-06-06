<!-- Modal -->
<div class="modal fade" id="CommentsModal" tabindex="-1" aria-labelledby="CommentsModalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="title mb-0">Comments</h3>
        <button type="button" class="btn-close mb-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="comments-wrap">
          <div class="room-details-review">
            <div class="reviews-wrap mt-4">
              <ul>
                @foreach ($all_comments as $comment)
                  @if ($comment->user_id == Auth::user()->id)
                    <div class="d-flex align-middle justify-content-between mb-2">
                      <h2 class="mb-2">Your Comment</h2>
                      <form action="{{ route('comment.delete', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn border-none">
                          <h3 class="text-danger mt-0 mb-0"><i class='bx bx-trash pt-1'></i> Delete</h3>
                        </button>
                      </form>
                    </div>
                    <p> {{ $comment->created_at->format('M d, Y') }}</p>
                    <form action="{{ route('comment.update', $comment->id) }}" method="post" class="mb-5">
                      @csrf
                      @method('PATCH')
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <textarea name="message{{$comment->id}}" class="form-control @error("message$comment->id") is-invalid @enderror" 
                                      id="message" cols="30" rows="8" 
                                      data-error="Write your message" placeholder="Your Message" >{{ old("message$comment->id", $comment->message )}}</textarea>
                            @error("message$comment->id")
                              <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <button type="submit" class="default-btn btn-bg-three">
                            <i class='bx bx-edit fs-5 '></i> Update A Comment
                          </button>
                        </div>
                      </div>
                    </form>
                  @else
                    <li>
                      <img src="{{ $comment->user->photo ?  url('upload/user_images/' .$comment->user->photo) : 
                      url('upload/no_image.jpg') }}"  alt="{{ $comment->user->name }}" style="height: 50px; width:50px;">
                      <h3>{{ $comment->user->name }}</h3>
                      <span> {{ $comment->created_at->format('M d, Y') }}</span>
                      <p>
                        <p class="white-space-pre">{!! nl2br(e($comment->message)) !!}</p>
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
</div>
