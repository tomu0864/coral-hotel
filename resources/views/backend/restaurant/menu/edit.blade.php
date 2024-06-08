@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Restaurant</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Edit Menu
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
              <h5 class="mb-4">Edit Restaurant Menu
              </h5>
              <form action="{{ route('restaurant.menu.update', $menu->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="col-md-4">
                  <label for="category_id" class="form-label">Category</label>
                  <select id="category_id" name="category_id" class="form-select" autofocus>
                    <option disabled>Select Category...</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ $menu->category->id ==  $category->id  ? 'selected' : ''}}>
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('category_id')
                    <p class="mb-0 text-danger">{{ $message }}</p>
                  @enderror
                </div>
                
                <div class="col-md-4">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" 
                         name="name" id="name" value="{{ old('name', $menu->name) }}">
                         @error('name')
                           <p class="mb-0 text-danger">{{ $message }}</p>
                         @enderror
                </div>
                
                <div class="col-md-4">
                  <label for="price" class="form-label">Price</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text bg-light" id="basic-addon1">$</span>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           name="price" id="price" value="{{ old('price', $menu->price) }}">
                           @error('price')
                           <p class="mb-0 text-danger">{{ $message }}</p>
                          @enderror
                  </div>
                </div>


                <div class="col-md-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description"  rows="5">{{ old('description', $menu->description) }}</textarea>
                            @error('description')
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
                  <img src="{{ $menu->image }}" alt="Post Image" id="showImage" class="p-1 w-100">
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