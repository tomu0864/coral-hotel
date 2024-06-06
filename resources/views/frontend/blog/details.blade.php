@extends('frontend.main')
@section('main')
    <!-- Inner Banner -->
    <div class="inner-banner inner-blog">
      <div class="container">
          <div class="inner-title">
              <ul>
                  <li>
                      <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li><i class='bx bx-chevron-right'></i></li>
                  <li>Blog Details </li>
              </ul>
              <h3>{{ $blog->post_title }}</h3>
          </div>
      </div>
  </div>
  <!-- Inner Banner End -->

  <!-- Blog Details Area -->
  <div class="blog-details-area pt-100 pb-70">
      <div class="container">
          <div class="row">
              <div class="col-lg-8">
                  <div class="blog-article">
                      <div class="blog-article-img">
                          <img class="w-100" src={{ asset($blog->post_image) }} alt="{{ $blog->post_title }}">
                      </div>

                      <div class="blog-article-title">
                          <h2>{{ $blog->post_title }}</h2>
                          <ul>
                              
                              <li>
                                  <i class='bx bx-user fs-4 pt-1'></i>
                                  By {{ $blog->author->name }}
                              </li>

                              <li>
                                  <i class='bx bx-calendar fs-4 pt-1'></i>
                                  {{ $blog->created_at->format('M d, Y') }}
                              </li>

                            @if ($blog->isLiked())
                              <li>
                                <form action="{{ route('like.delete', $blog->id) }}" method="post" class="d-inline">
                                  @csrf
                                  @method('DELETE')

                                   <button type="submit" class="border-0 p-0 btn fs-4 mb-1">
                                       <i class='bx bx-like'></i>
                                    </button>    
                                </form>
                                {{ count($blog->likes) }}
                              </li>
                             @else
                              <li>
                                <form action="{{ route('like.store', $blog->id) }}" method="post" class="d-inline">
                                   @csrf

                                   <button type="submit" class="p-0 btn fs-4 mb-1">
                                       <i class='bx bx-like text-muted'></i>
                                    </button>    
                                </form>
                                {{ count($blog->likes) }}
                              </li>
                             @endif
                              
                          </ul>
                      </div>
                      
                      <div class="article-content">
                          <p>{!! $blog->long_desc !!}</p>
                      </div>

                      @php
                          $comments = App\Models\Comment::where('post_id', $blog->id)->where('status', '1')->latest()->take(3)->get();
                          $all_comments = App\Models\Comment::where('post_id', $blog->id)->where('status', '1')->latest()->get();
                      @endphp

                      <div class="comments-wrap mt-5">
                        <h3 class="title">Comments</h3>
                        <ul>
                        
                          @foreach ($comments as $comment)
                          <div class="comments-form mb-0">
                            <div class="contact-form px-4 mb-0 pb-3">
                                
                            @if ($comment->user_id == Auth::user()->id)
                             <div class="d-flex align-middle justify-content-between">
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
                          <form action="{{ route('comment.update', $comment->id) }}" method="post">
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
                        </div>

                        </div>
                          @else
                          
                          <li class="mb-0 py-0">
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

                        @if ($all_comments->count() > 3)

                        <button type="button" class="btn mt-2 fw-bold" data-bs-toggle="modal" data-bs-target="#CommentsModal" style="color: #ee786c;">
                            See All Comments
                          </button>
                            
                        @endif

                        @include('frontend.blog.modals.comment')

                      </div>

                      <div class="comments-form">
                          <div class="contact-form">
                              <h2>Leave A Comment</h2>
                      @auth
                          
                            <form action="{{ route('comment.store', $blog->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" 
                                                        id="message" cols="30" rows="8" 
                                                        data-error="Write your message" placeholder="Your Message" >{{ old('message')}}</textarea>
                                                        @error('message')
                                                            <p class="mb-0 text-danger">{{ $message }}</p>
                                                        @enderror
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="default-btn btn-bg-three">
                                                    Post A Comment
                                                </button>
                                        </div>
                                    </div>
                                </form>

                                @else

                                <p>Please <a href="{{ route('login') }}" style="color: #ee786c;" class="fw-bold">Login</a> first to leace a comment</p>

                              @endauth
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                @include('frontend.blog.partials.sidebar')
                {{-- Sidebar End --}}
          </div>
      </div>
  </div>
  <!-- Blog Details Area End -->  
@endsection