@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Testimonial</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Testimonial</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <a href="{{ route('testimonial.add') }}" class="btn btn-primary px-5 radius-30">
      Add Testimonial
     </a>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Testimonial List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Image</th>
              <th>Name</th>
              <th>city</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($testimonials as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td><img src="{{ $item->image }}" alt="Team Member Image" class="img-thumbnail" style="width:70px; height: 60px;"></td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->city }}</td>
              <td>
                <a href="{{ route('testimonial.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                <form action="{{ route('testimonial.delete', $item->id) }}" id="deleteTestimonial{{ $item->id }}" method="post" class="deleteTestimonial d-inline">
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