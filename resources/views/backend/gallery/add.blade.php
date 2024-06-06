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
          <li class="breadcrumb-item active" aria-current="page">Add Gallery</li>
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
              <form action="{{ route('gallery.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                  <label for="category_name" class="form-label">Category</label>
                  <select name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror">
                    <option value="" selected disabled>Select Category</option>
                    <option value="room">Room</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="facility">Facility</option>
                  </select>
                  @error('category')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="multiImg" class="form-label">Gallery Photo</label>
                  <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo[]" id="multiImg" value="{{ old('photo') }}" multiple>
                  <div class="row mt-2" id="preview_img"></div>
                  @error('photo')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
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

<script>
  $(document).ready(function() {
    $('#multiImg').on('change', function() {
      if (window.File && window.FileReader && window.FileList && window.Blob) {
        var data = $(this)[0].files;
        $.each(data, function(index, file) {
          if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
            var fRead = new FileReader();
            fRead.onload = (function(file) {
              return function(e) {
                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80);
                $('#preview_img').append(img);
              };
            })(file);
            fRead.readAsDataURL(file);
          }
        });
      } else {
        alert("Your browser doesn't support File API!");
      }
    });
  });
</script>
@endsection
