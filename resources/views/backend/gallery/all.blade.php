@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Gallery</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Gallery List</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <a href="{{ route('gallery.add') }}" class="btn btn-primary px-5 radius-30">
      Add Gallery
     </a>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Gallery List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <form action="{{ route('gallery.delete.multiple') }}" method="post">
          @csrf
          @method('DELETE')

          <table id="example" class="table table-striped table-bordered" style="width:100%">
           <thead>
            <tr>
              <th width="50px">Select</th>
              <th width="50px">SI</th>
              <th>Category</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($galleries as $key => $item)
                
            <tr class="align-middle">
              <td><input type="checkbox" name="selectedItem[]" value="{{ $item->id }}"></td>
              <td>{{ $key+1 }}</td>
              <td>{{ $item->category_name }}</td>
              <td><img src="{{ $item->photo }}" alt="Gallery Image" class="img-thumbnail" style="width:70px; height: 60px;"></td>
              <td>
                <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-danger mt-2 mb-4">Delete Selected</button>
      </form>
      </div>
    </div>
  </div>
 
  {{-- <hr/> --}}

</div>

@endsection