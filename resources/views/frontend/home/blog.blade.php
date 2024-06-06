@php
    $blogPosts = App\Models\BlogPost::latest()->take(3)->get();
@endphp

<div class="blog-area pt-100 pb-70">
  <div class="container">
      <div class="section-title text-center">
          <span class="sp-color">BLOGS</span>
          <h2>Our Latest Blogs to the Intranational Journal at a Glance</h2>
      </div>
      <div class="row pt-45">
        @foreach ($blogPosts as $blog)
            
          <div class="col-lg-4 col-md-6">
              <div class="blog-item">
                  <a href="{{ url('blog/details/'.$blog->post_slug) }}">
                      <img src="{{ asset($blog->post_image) }}" alt="{{ $blog->post_title }}">
                  </a>
                  <div class="content">
                      <ul>
                          <li>{{ $blog->created_at->format('M d, Y') }}</li>
                          <li><i class='bx bx-like'></i>{{ count($blog->likes) }}</li>
                          <li><i class='bx bx-message-alt-dots'></i>{{ count($blog->comments) }}</li>
                      </ul>
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
          @endforeach
      </div>
  </div>
</div>