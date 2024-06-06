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
          <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <form action="{{ route('restaurant.category.store') }}" method="post" class="d-flex">
        @csrf
        <div class="form-group flex-grow-1 me-2">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" placeholder="Enter category name...">
            @error('name')
                <p class="text-danger mb-0">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="form-group flex-grow-1 me-2">
            <input type="text" name="time" class="form-control @error('time') is-invalid @enderror" 
                   value="{{ old('time') }}" placeholder="Time: ex) 8:00 - 12:00">
            @error('time')
                <p class="text-danger mb-0">{{ $message }}</p>
            @enderror
        </div>
    
        <button class="btn btn-primary flex-shrink-0">
            Add
        </button>
    </form>
    
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Category List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $key => $item)
            @include('backend.modals.restaurant_category', ['item' => $item])
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td>{{ $item->name }}</td>
              <td>
                <button type="button" class="btn btn-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $item->id }}">
                  Edit
                </button>
                <form action="{{ route('restaurant.category.delete', $item->id) }}" id="deleteRestaurantCat{{ $item->id }}" method="post" class="deleteRestaurantCat d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger px-3 radius-30">Delete</button>
              </form>
              </td>
            </tr>
            @endforeach
     
          </tbody>
         
        </table>
      </div>
    </div>
  </div>
 
  {{-- <hr/> --}}

</div>

@endsection