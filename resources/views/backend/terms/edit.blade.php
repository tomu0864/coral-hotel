@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Terms Conditions</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Edit Terms Conditions</li>
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
              <h5 class="mb-4">Edit Terms Conditions
              </h5>
              <form action="{{ route('term.update', $term->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PAtCH')

                <div class="col-md-12">
                  <label for="content" class="form-label">Main Description</label>
                  <textarea class="form-control @error('content') in-invalid @enderror" 
                            name="content" id="myeditorinstance" rows="3">{!! old('content', $term->content) !!}</textarea>
                            @error('content')
                              <p class="mb-0 text-danger">{{ $message }}</p>
                            @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control @error('image') is-invalid @enderror" 
                         name="image" id="image">
                         @error('image')
                              <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                </div>

                <div class="col-md-6">
                  <img src="{{ asset($term->image) }}" alt="Terms Conditions Image" id="showImage" class="p-1 w-100">
                </div>
                
                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
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
      $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });
  
  </script>

@endsection