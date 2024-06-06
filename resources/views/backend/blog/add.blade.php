@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Blog</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Add Post</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-4">
              <h5 class="mb-4">New BLog Post
              </h5>
              <form action="{{ route('blog.post.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                  <label for="category_id" class="form-label">Category</label>
                  <select id="category_id" name="category_id" class="form-select">
                    <option hidden>Select Category...</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') ==  $category->id  ? 'selected' : ''}}>
                        {{ $category->category_name }}
                      </option>
                    @endforeach
                  </select>
                  @error('category_id')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label for="post_title" class="form-label">Title</label>
                  <input type="text" class="form-control @error('post_title') is-invalid @enderror" 
                         name="post_title" id="post_title" value="{{ old('post_title') }}">
                         @error('post_title')
                           <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>

                <div class="col-md-12">
                  <label for="short_desc" class="form-label">Short Description</label>
                  <textarea class="form-control @error('short_desc') is-invalid @enderror" 
                            id="short_desc" name="short_desc"  rows="3">{{ old('short_desc') }}</textarea>
                            @error('short_desc')
                            <p class="mb-0 text-danger">{{ $message }}</p>
                          @enderror
                </div>

                <div class="col-md-12">
                  <label for="long_desc" class="form-label">Main Description</label>
                  <textarea class="form-control @error('long_desc') in-invalid @enderror" 
                            name="long_desc" id="myeditorinstance" rows="3">{!! old('long_desc') !!}</textarea>
                            @error('long_desc')
                              <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="post_image" class="form-label">Image</label>
                  <input type="file" class="form-control @error('post_image') is-invalid @enderror" 
                         name="post_image" id="post_image">
                         @error('post_image')
                              <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                </div>

                <div class="col-md-6">
                  <img src="{{ url('upload/no_image.jpg') }}" alt="Post Image" id="showImage" class="p-1 w-100">
                </div>
                
                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">
  // Dispaly uploading image
  
    $(document).ready(function(){
      $('#post_image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });
  
  </script>

@endsection