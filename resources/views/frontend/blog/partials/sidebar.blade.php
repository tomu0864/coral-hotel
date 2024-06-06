<div class="col-lg-4">
  <div class="side-bar-wrap">
      <div class="search-widget">
          <form class="search-form" action="{{ route('blog.list') }}"  method="get">
              <input type="search" class="form-control" placeholder="Search..." name="search">
              <button type="submit">
                  <i class="bx bx-search"></i>
              </button>
          </form>
      </div>

      <div class="services-bar-widget">
          <h3 class="title">Blog Category</h3>
          <div class="side-bar-categories">
              <ul>
                @foreach ($categories as $category)
                <li>
                    <a href="{{ url('blog/category/'.$category->category_slug) }}">{{ $category->category_name }}</a>
                </li>
                @endforeach
              </ul>
          </div>
      </div>

      <div class="side-bar-widget">
          <h3 class="title">Recent Posts</h3>
          <div class="widget-popular-post">
            @foreach ($latest_posts as $lpost)
              
              <article class="item">
                  <a href="{{ url('blog/details/'.$lpost->post_slug) }}" class="thumb">
                    <img style="width: 80px; height:80px" src={{ asset($lpost->post_image) }} alt="{{ $lpost->post_title }}">
                  </a>
                  <div class="info">
                      <h4 class="title-text">
                          <a href="{{ url('blog/details/'.$lpost->post_slug) }}">
                              {{ $lpost->post_title }}
                          </a>
                      </h4>
                      <ul>
                          <li>
                              <i class='bx bx-like'></i>
                              {{ count($lpost->likes) }}
                          </li>
                          <li>
                              <i class='bx bx-message-square-detail'></i>
                                {{  $lpost->comments->count() }}
                          </li>
                      </ul>
                  </div>
              </article>
             @endforeach
          </div>
      </div>       
    </div>
</div>