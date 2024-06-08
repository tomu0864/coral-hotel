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
              <li>Blog</li>
          </ul>
          <h3>Welcome to our blog</h3>
      </div>
  </div>
</div>
<!-- Inner Banner End -->

<!-- Blog Style Area -->
<div class="blog-style-area pt-100 pb-70">
  <div class="container">
      <div class="row">
          <div class="col-lg-8">
            @forelse ($blogPosts as $blog)
                
              <div class="col-lg-12">
                  <div class="blog-card">
                      <div class="row align-items-center">
                          <div class="col-lg-5 col-md-4 p-0">
                              <div class="blog-img">
                                  <a href="{{ url('blog/details/'.$blog->post_slug) }}">
                                      <img src="{{ $blog->post_image }}" alt="Images">
                                  </a>
                              </div>
                          </div>

                          <div class="col-lg-7 col-md-8 p-0">
                              <div class="blog-content">
                                  <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                  <h3>
                                      <a href="{{ url('blog/details/'.$blog->post_slug) }}">{{ $blog->post_title }}</a>
                                  </h3>
                    
                                    <span class="me-1">
                                        <i class='bx bx-like'></i>
                                        {{ count($blog->likes) }}
                                    </span>

                                    <span>
                                          <i class='bx bx-message-square-detail'></i>
                                          {{  $blog->comments->count() }}
                                    </span>

                                  <p>{{ $blog->short_desc }}</p>
                                  <a href="{{ url('blog/details/'.$blog->post_slug) }}" class="read-btn">
                                      Read More
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              @empty
              {{-- Check if search term is provided --}}
                @if(request()->has('search') && request()->search != '')

                  <h1 class="text-center mb-5">No posts found</h1>
                  <h5 class="text-center mb-5">Please try again with some different keywords.</h5>

                @else

                  <h2 class="text-center mb-5">Sorry! We're getting ready for posts</h2>
                  
                @endif

            @endforelse

              <div class="col-lg-12 col-md-12">
                  <div class="pagination-area">

                    {{ $blogPosts->links('vendor.pagination.custom') }}

                  </div>
              </div>
          </div>
          
           {{-- Sidebar --}}
           @include('frontend.blog.partials.sidebar')
           {{-- Sidebar End --}}
      </div>
  </div>
</div>
<!-- Blog Style Area End -->

@endsection