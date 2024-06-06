@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Room Number</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Edit Room Number</li>
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

        <div class="col-lg-8">
          <div class="card">
            <form action="{{ route('room.number.update', $edit_room_no->id) }}" id="myForm" method="post">
                @csrf
                @method('PATCH')

              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Room Number</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="room_no" value="{{ old('room_no', $edit_room_no->room_no) }}" class="form-control" required/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Room Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary form-group">
                      <select id="status" name="status" class="form-select" required>
                        <option selected hidden>Choose Status...</option>
                        <option value="Active" {{ $edit_room_no->status === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $edit_room_no->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>			
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                      <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                    </div>
                  </div>
                </div>
              </div>
           </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
            room_no: {
                  required : true,
              }, 
              status: {
                  required : true,
              }, 
              
          },
          messages :{
              field_name: {
                  required : 'Please Enter Room Number',
              }, 

              field_name: {
                  required : 'Please Select Status',
              }, 

          },
          errorElement : 'span', 
          errorPlacement: function (error,element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight : function(element, errorClass, validClass){
              $(element).addClass('is-invalid');
          },
          unhighlight : function(element, errorClass, validClass){
              $(element).removeClass('is-invalid');
          },
      });
  });
  
</script>

@endsection