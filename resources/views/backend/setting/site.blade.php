@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Settings</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
        </ol>
      </nav>
    </div>
  </div>
    
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Basic Site Settings</h6>
  <hr/>
  <div class="container">
    <div class="main-body">
      <div class="row">

        <div class="col-lg-8">
          <div class="card">
            <form action="{{ route('setting.site.update', $site->id) }}" id="myForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="tel" name="phone" value="{{ old('phone', $site->phone) }}" class="form-control"/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="address" value="{{ old('address', $site->address) }}"  class="form-control"/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="email" value="{{ old('email', $site->email) }}" name="email" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Facebook</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('facebook', $site->facebook) }}" name="facebook" class="form-control"  />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Twitter</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('twitter', $site->twitter) }}" name="twitter" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Instagram</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('instagram', $site->instagram) }}" name="instagram" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Youtube</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('youtube', $site->youtube) }}" name="youtube" class="form-control"  />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Copyright</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('copyright', $site->copyright) }}" name="copyright" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Photo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="file" name="image" class="form-control" id="image">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0"></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <img id="showImage" src="{{ asset($site->logo) }}" alt="Logo" class="rounded-circle p-1" width="100" height="100">
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

<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
            phone: {
                  required : true,
              }, 
              address: {
                  required : true,
              }, 
              email: {
                  required : true,
              }, 
              copyright: {
                  required : true,
              }, 
              : {
                  required : true,
              }, 
              
          },
          messages :{
              field_name: {
                  required : 'Please enter phone',
              }, 

              field_name: {
                  required : 'Please enter address',
              }, 
              field_name: {
                  required : 'Please enter email',
              }, 
              field_name: {
                  required : 'Please enter copyright',
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