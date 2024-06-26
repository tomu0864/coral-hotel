@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Admin User</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Admin User</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <a href="{{ route('admin.add') }}" class="btn btn-primary px-5 radius-30">
         Add Admin
       </a>
     </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">All Admin User</h6>
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
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allAdmin as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td class="text-center">
                <img src="{{ (!empty($item->photo)) ?  
                $item->photo : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1" width="70" height="70" style="object-fit: cover">              
              </td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td class="text-center">
                @foreach ($item->roles as $role)
                  <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                @endforeach
              </td>
              <td>
                <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                <form action="{{ route('admin.delete', $item->id) }}" id="deleteAdmin{{ $item->id }}" method="post" class="deleteAdmin d-inline">
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