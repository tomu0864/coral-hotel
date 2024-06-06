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
              <li>Category</li>
          </ul>
          <h3>{{ $category->category_name }}</h3>
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
                                      <img src="{{ asset($blog->post_image) }}" alt="Images">
                                  </a>
                              </div>
                          </div>

                          <div class="col-lg-7 col-md-8 p-0">
                              <div class="blog-content">
                                  <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                  <h3>
                                      <a href="{{ url('blog/details/'.$blog->post_slug) }}">{{ $blog->post_title }}</a>
                                  </h3>
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
              <h2 class="text-center mb-5">No post yet related to {{ $category->category_name }}</h2>
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