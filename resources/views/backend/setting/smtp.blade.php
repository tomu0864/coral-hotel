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
          <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
        </ol>
      </nav>
    </div>
  </div>
    
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">

        <div class="col-lg-8">
          <div class="card">
            <form action="{{ route('setting.smtp.update', $smtp->id) }}" id="myForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mailer</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="mailer" value="{{ old('mailer', $smtp->mailer) }}" class="form-control"/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Host</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="host" value="{{ old('host', $smtp->host) }}"  class="form-control"/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Port</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('port', $smtp->port) }}" name="port" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('username', $smtp->username) }}" name="username" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                        <input type="password" name="password" class="form-control"  value="{{ old('password', $smtp->password) }}"   />
                    </div>
                </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Encryoption</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('encryption', $smtp->encryption) }}" name="encryption" class="form-control"  />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">From Address</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" value="{{ old('from_address', $smtp->from_address) }}" name="from_address" class="form-control"  />
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
            mailer: {
                  required : true,
              }, 
              host: {
                  required : true,
              }, 
              port: {
                  required : true,
              }, 
              username: {
                  required : true,
              }, 
              password: {
                  required : true,
              }, 
              encryption: {
                  required : true,
              }, 
              from_address: {
                  required : true,
              }, 
              
          },
          messages :{
              field_name: {
                  required : 'Please enter smtp mailer',
              }, 

              field_name: {
                  required : 'Please enter smtp host',
              }, 
              field_name: {
                  required : 'Please enter smtp port',
              }, 
              field_name: {
                  required : 'Please enter smtp username',
              }, 
              field_name: {
                  required : 'Please enter smtp password',
              }, 
              field_name: {
                  required : 'Please enter smtp encryption',
              }, 
              field_name: {
                  required : 'Please enter smtp from address',
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