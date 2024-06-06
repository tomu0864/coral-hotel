@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Role & Permission</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Permission</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <a href="{{ route('role.permission.add') }}" class="btn btn-primary px-5 radius-30">
         Add Permission
       </a>
     </div>

      <div class="btn-group">
        <a href="{{ route('role.permission.export') }}" class="btn btn-warning px-5 radius-30">
         Export
       </a>
     </div>

      <div class="btn-group">
        <a href="{{ route('role.permission.import') }}" class="btn btn-danger px-5 radius-30">
         Import
       </a>
     </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">All Permission</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Permission Name</th>
              <th>Permission Group</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($permissions as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->group_name }}</td>
              <td>
                <a href="{{ route('role.permission.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                <form action="{{ route('role.permission.delete', $item->id) }}" id="deletePermission{{ $item->id }}" method="post" class="deletePermission d-inline">
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