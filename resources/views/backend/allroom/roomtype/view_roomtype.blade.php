@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Room Type List</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <a href="{{ route('room.type.add') }}" class="btn btn-primary px-5 radius-30">
      Add Room Type
     </a>
    </div>
  </div>
  <!--end breadcrumb-->
  
  <h6 class="mb-0 text-uppercase">Room Type List</h6>
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
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_data as $key => $item)

            @php
              $rooms = App\Models\Room::where('roomtype_id', $item->id)->get();
            @endphp
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td class="text-center">
                <img src="{{ $item->room->image ? 
                     $item->room->image : url('upload/no_image.jpg')}}" 
                alt="{{ $item->name }}" style="width: 50px; height:50px;">
              </td>
              <td>{{ $item->name }}</td>
              <td>
                 @foreach ($rooms as $room)
                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                <form action="{{ route('room.delete',$room->id) }}" id="deleteRoom" method="post" class="deleteRoom d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger px-3 radius-30">Delete</button>
                @endforeach
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