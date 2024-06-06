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
          <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</button>
    </div>

  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Blog Category</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Category Name</th>
              <th>Category Slug</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td>{{ $item->category_name }}</td>
              <td>{{ $item->category_slug }}</td>
              <td>
                <button type="button" class="btn btn-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#editCategoryModal" 
                        id="{{ $item->id }}" onclick="categoryEdit(this.id)">Edit</button>
                <form action="{{ route('blog.category.delete', $item->id) }}" id="deleteBlogCategory" method="post" class="deleteBlogCategory d-inline">
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

{{-- Modal for adding category --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fst-italic" id="categoryModallLabel">BLog Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('blog.category.store') }}" method="post">
          @csrf
          <div class="form-group mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" id="category_name" 
                   class="form-control  @error('category_name') is-invalid @enderror" 
                   value="{{ old('category_name') }}" autofocus>
                   @error('category_name')
                     <p class="mb-0 text-danger">{{ $message }}</p>
                   @enderror
          </div>
      </div>
      <div class="modal-footer border-0">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

{{-- Modal for editting category --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fst-italic" id="editCategoryModallLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('blog.category.update') }}" method="post">
          @csrf
          @method('PATCH')

          <input type="hidden" name="cat_id" id="cat_id">
          <div class="form-group mb-3">
            <label for="catEdit" class="form-label">Category Name</label>
            <input type="text" name="category_name" id="catEdit" 
                   class="form-control  @error('category_name') is-invalid @enderror" 
                   value="{{ old('category_name') }}" autofocus>
                   @error('category_name')
                     <p class="mb-0 text-danger">{{ $message }}</p>
                   @enderror
          </div>
      </div>
      <div class="modal-footer border-0">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>
  function categoryEdit(id){
    $.ajax({
      type:'GET',
      url: '/blog/category/edit/'+id,
      dataType: 'json',

      success:function(data){
        // console.log(data)
        $('#catEdit').val(data.category_name);
        $('#cat_id').val(data.id);
      }
    })
  }
</script>

@endsection