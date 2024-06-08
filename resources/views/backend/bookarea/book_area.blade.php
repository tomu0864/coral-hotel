@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Book Area</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Update Book Area</li>
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
            <form action="{{ route('book.area.update') }}" id="myForm" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $book->id }}">

              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Subtitle</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="subtitle" value="{{ old('subtitle', $book->subtitle) }}" class="form-control" autofocus />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Main Title</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="main_title" value="{{ old('main_title', $book->main_title) }}"  class="form-control"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Short Description</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <textarea name="short_desc" rows="3" class="form-control" placeholder="Description" >{{ old('short_desc', $book->short_desc) }}</textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Link Url</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="text" name="link_url" value="{{ old('link_url', $book->link_url) }}" class="form-control"  />
                    </div>
                  </div>
               
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Photo</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                      <input type="file" name="image" class="form-control" id="image">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0"></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <img id="showImage" src="{{ $book->image }}" alt="BookArea" class="rounded-circle p-1 bg-primary" width="80" height="80">
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
            subtitle: {
                  required : true,
              }, 
              main_title: {
                  required : true,
              }, 
              short_desc: {
                  required : true,
              }, 
              link_url: {
                  required : true,
              }, 
              image: {
                  required : true,
              }, 
              
          },
          messages :{
              field_name: {
                  required : 'Please Enter Subtitle',
              }, 

              field_name: {
                  required : 'Please Enter Main Title',
              }, 
              field_name: {
                  required : 'Please Enter Description',
              }, 
              field_name: {
                  required : 'Please Enter URL Link',
              }, 
              field_name: {
                  required : 'Please Photo',
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