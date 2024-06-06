@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Gallery</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Gallery</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto"></div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body p-4">
              <form action="{{ route('gallery.update', $gallery->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                  <label for="category_name" class="form-label">Category</label>
                  <select name="category_name" id="category_name" class="form-control @error('category') is-invalid @enderror">
                    <option value="" hidden>Select Category</option>
                    <option value="room" {{ $gallery->category_name == "room" ? 'selected' : '' }}>Room</option>
                    <option value="restaurant" {{ $gallery->category_name == "restaurant" ? 'selected' : '' }}>Restaurant</option>
                    <option value="facility" {{ $gallery->category_name == "facility" ? 'selected' : '' }}>Facility</option>
                  </select>
                  @error('category')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div> 
                <div class="col-md-6">
                  <label for="multiImg" class="form-label">Gallery Photo</label>
                  <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" value="{{ old('photo') }}">
                  <div class="row mt-2" id="preview_img"></div>
                  @error('photo')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="col-md-12">
                  <img id="showImage" src="{{ asset($gallery->photo) }}" alt="{{ $gallery->category_name }}" class="rounded-circle p-1 bg-primary" width="100" height="100">
                </div>

                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Upload</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // Dispaly uploading image
  
    $(document).ready(function(){
      $('#photo').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });
  
  </script>

@endsection
