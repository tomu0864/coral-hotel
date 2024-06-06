@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--Navbar Tab-->

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-primary" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" data-bs-toggle="tab" href="#RoomTypeEdit" role="tab" aria-selected="true">
            <div class="d-flex align-items-center">
              <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
              </div>
              <div class="tab-title">Manage Room</div>
            </div>
          </a>
        </li>

        <li class="nav-item" role="presentation">
          <a class="nav-link " data-bs-toggle="tab" href="#roomImages" role="tab" aria-selected="true">
            <div class="d-flex align-items-center">
              <div class="tab-icon"><i class="bx bx-images font-18 me-1"></i>
              </div>
              <div class="tab-title">Room Images</div>
            </div>
          </a>
        </li>

        <li class="nav-item" role="presentation">
          <a class="nav-link" data-bs-toggle="tab" href="#roomNumber" role="tab" aria-selected="false" tabindex="-1">
            <div class="d-flex align-items-center">
              <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
              </div>
              <div class="tab-title">Room Number</div>
            </div>
          </a>
        </li>
      
      </ul>

      <div class="tab-content py-3 mt-3">
        {{-- Manage Room --}}
        <div class="tab-pane fade show active" id="RoomTypeEdit" role="tabpanel">
          <div class="col-xl-12 mx-auto">
						
						<div class="card">
							<div class="card-body p-4">
								<h5 class="mb-4">Room Details</h5>
								<form class="row g-3" action="{{ route('room.update', $room->id) }}" method="post" id="updateRoomForm">
                  @csrf
                  @method('PATCH')

									<div class="col-md-4">
										<label for="roomtype" class="form-label">Room Type name</label>
										<input type="text" class="form-control" name="roomtype" id="roomtype" value="{{ old('roomtype', $room->type->name) }}">
									</div>

									<div class="col-md-4">
										<label for="total_adult" class="form-label">Total Adult</label>
										<input type="number" name="total_adult" class="form-control" id="total_adult" value="{{ old('total_adult', $room->total_adult) }}">
									</div>

									<div class="col-md-4">
										<label for="total_child" class="form-label">Total Child</label>
										<input type="number" name="total_child" class="form-control" id="total_child" value="{{ old('total_child', $room->total_child) }}">
									</div>
									<div class="col-md-6">
										<p class="mb-0">Main Image</p>

                    <img id="showImage" src="{{ (!empty($room->image) ? url('upload/rooming/' .$room->image) : 
                         url('upload/no_image.jpg')) }}" alt="{{ $room->name . "'s Main Image" }}" 
                         class="bg-primary mt-2 img-thumbnail" style="height:95px">
									</div>
									<div class="col-md-6">
										<p class="mb-0">Gallery Image</p>

                           @foreach ($multiImgs as $item)
                              <img src="{{ (!empty($item->multi_img) ? url('upload/rooming/multi_img/' .$item->multi_img) : 
                                    url('upload/no_image.jpg')) }}" alt="{{ $room->name . "'s Subimage" }}" 
                                    class="bg-primary mt-2 img-thumbnail" width="60" height="30">
                                    <a href="{{ route('room.multi.image.delete', $item->id) }}"><i class="bx bx-trash"></i></a>
                           @endforeach

                  </div>

                  <div class="col-md-3">
                    <label for="price" class="form-label">Room Price</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{ old('price', $room->price) }}">
                  </div>

                  <div class="col-md-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" name="discount" class="form-control" id="discount" value="{{ old('discount', $room->discount) }}">
                  </div>

                  <div class="col-md-3">
                    <label for="size" class="form-label">Room Size</label>
                    <input type="text" name="size" class="form-control" id="size" value="{{ old('size', $room->size) }}">
                  </div>
                  <div class="col-md-3">
                    <label for="room_capacity" class="form-label">Number of Rooms</label>
                    <input type="number" name="room_capacity" class="form-control" id="room_capacity" value="{{ old('room_capacity', $room->room_capacity) }}">
									</div>

                  <div class="col-md-6">
										<label for="view" class="form-label">Room View</label>
										<select id="view" name="view" class="form-select">
											<option selected hidden>Choose View...</option>
											<option value="Sea View" {{ $room->view === 'Sea View' ? 'selected' : ''}}>Sea View</option>
											<option value="Hill View" {{ $room->view === 'Hill View' ? 'selected' : ''}}>Hill View</option>
											<option value="City View" {{ $room->view === 'CIty View' ? 'selected' : ''}}>City View</option>
										</select>
									</div>

                  <div class="col-md-6">
										<label for="bed_style" class="form-label">Bed Style</label>
										<select id="bed_style" name="bed_style" class="form-select">
											<option selected hidden>Choose Bed Style...</option>
											<option value="Single Bed" {{ $room->bed_style === 'Single Bed' ? 'selected' : ''}}>Sngle Bed</option>
											<option value="Twin Bed" {{ $room->bed_style === 'Twin Bed' ? 'selected' : ''}}>Twin Bed</option>
											<option value="Queen Bed" {{ $room->bed_style === 'Queen Bed' ? 'selected' : ''}}>Queen Bed</option>
											<option value="King Bed" {{ $room->bed_style === 'King Bed' ? 'selected' : ''}}>King Bed</option>
										</select>
									</div>
									
									<div class="col-md-12">
										<label for="short_desc" class="form-label">Short Description</label>
										<textarea class="form-control" name="short_desc" id="short_desc" rows="3">{{ old('short_desc', $room->short_desc) }}</textarea>
                    @error('short_desc')
                      <p class="text-danger mb-0">{{ $message }}</p>
                    @enderror
									</div>

									<div class="col-md-12 mb-2">
										<label  class="form-label">Description</label>
										<textarea class="form-control" name="description" id="myeditorinstance" rows="3">{!! old('description', $room->description) !!}</textarea>
									</div>
                  
                  @forelse ($room_facility as $item)
                  <div class="row mt-2">
                    <div class="col-md-12 mb-3">
                      <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                        <div class="row add_item">
                          <div class="col-md-6">
                            <label for="facility_name" class="form-label">Room Facilities</label>
                            <select name="facility_name[]" class="form-control">
                              <option value="" hidden>Select Facility</option>
                                @foreach ($facility as $option)
                              <option value="{{ $option->name }}" {{ $item->facility_name == $option->name ? 'selected' : '' }}>
                                  {{ $option->name }}
                                </option>                                            
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group col-md-6 d-flex gap-1" style="padding-top: 30px">
                              <span class="btn btn-success addeventmore">
                                <i class="lni lni-circle-plus mx-auto"></i>
                              </span>
                              <span class="btn btn-danger removeeventmore">
                                <i class="lni lni-circle-minus mx-auto"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <br>

                @empty

                <div class="row mt-2">
                  <div class="col-md-12 mb-3">
                    <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                      <div class="row add_item">
                        <div class="col-md-6">
                          <label for="facility_name" class="form-label">Room Facilities</label>
                          <select name="facility_name[]" class="form-control">
                            <option value="" hidden>Select Facility</option>
                              @foreach ($facility as $option)
                           <option value="{{ $option->name }}">{{ $option->name }}</option>                                            
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group col-md-6 d-flex gap-1" style="padding-top: 30px">
                            <span class="btn btn-success addeventmore">
                              <i class="lni lni-circle-plus mx-auto"></i>
                            </span>
                            <span class="btn btn-danger removeeventmore">
                              <i class="lni lni-circle-minus mx-auto"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endforelse
								
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Save Changes</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
        </div>
        {{-- End Manage Room --}}



        {{-- Room Images --}}

        {{-- Fancy File Upload Main Image --}}
        <div class="tab-pane fade" id="roomImages" role="tabpanel">
          <div class="col-xl-9 mx-auto">
						<h6 class="mb-0 text-uppercase">Main Room Image</h6>
						<hr>
						<div class="card">
							<div class="card-body">
                <form id="formData">
								<input id="fancy_file_upload_main" type="file" name="single_image" multiple="false" accept=".jpg, .png, image/jpeg, image/png" class="ff_fileupload_hidden">
                @csrf
              </form>
                </div>
							</div>
						</div>

        {{--End Fancy File Upload Main Image --}}
          
         {{--Fancy File Upload Sub Image --}}
          <div class="col-xl-9 mx-auto">
						<h6 class="mb-0 text-uppercase">Sub Room Image</h6>
						<hr>
						<div class="card">
							<div class="card-body">
                <form id="formData">
								<input id="fancy_file_upload_sub" type="file" name="multi_img[]" accept=".jpg, .png, image/jpeg, image/png" class="ff_fileupload_hidden">
                @csrf
              </form>
                </div>
							</div>
						</div>
            <div class="col-xl-9 mx-auto">
              <p class="text-danger">
                * Please upload files first before you save changes
              </p>
              <div class="d-md-flex d-grid align-items-center gap-3">
                <a href="{{ route('room.edit', $room->id) }}" type="submit" class="btn btn-primary px-4">Save Changes</a>
              </div>
            </div>
          </div>

        {{--End Fancy File Upload Sub Image --}}


					
        {{-- End Room Images --}}

        {{-- Room Number --}}
        <div class="tab-pane fade" id="roomNumber" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-end">
              <a class="card-title btn btn-primary" onclick="addRoomNo()" id="addRoomNo">
                <i class='bx bx-plus-circle'></i> Add New
              </a>
            </div>
              <div class="roomNoHide" id="roomNoHide">
                <form action="{{ route('room.number.store', $room->id)}}" method="post" id="myForm">
                  @csrf
                  <div class="row">

                    <input type="hidden" name="roomtype_id" value="{{ $room->roomtype_id }}">
                   <div class="col-md-4 form-group">
                    <label for="room_no" class="form-label">Room Number</label>
                    <input type="number" name="room_no" class="form-control" id="room_no" value="{{ old('room_no') }}" required>
									 </div>

                   <div class="col-md-4 form-group">
                     <label for="status" class="form-label">Status</label>
                     <select id="status" name="status" class="form-select" required>
                       <option selected hidden>Choose Status...</option>
                       <option value="Active">Active</option>
                       <option value="Inactive">Inactive</option>			
										 </select>
									  </div>

                    <div class="col-md-4 d-flex align-items-end mt-3">
                     <button type="submit" class="btn btn-success">
                       Save
                     </button>
									  </div>
                  </div>
                </form>
              </div>
              
              <div class="table-responsive mt-5" id="roomNoTable">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="room_no" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Room Number
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="room_status" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Status
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="action" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_room_no as $item)
                    <tr>
                      <td>{{ $item->room_no }}</td>
                      <td>{{ $item->status }}</td>
                      <td>
                        <a href="{{ route('room.number.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                        <form action="{{ route('room.number.delete', $item->id) }}" method="post" class="d-inline deleteRoomNumber" id="deleteRoomNumber">
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
      </div>
          {{-- End Room Number --}}
        </div>
      
    </div>
  </div>

  <!--end Navbar Tab-->
  <div class="container">
    <div class="main-body">
      <div class="row">

        <div class="col-lg-8">
          <div class="card">
           
        </div>
      </div>
    </div>
  </div>
</div>


<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
{{-- Fancy File Load --}}

<script type="text/javascript">
  $(function() {
	$('#fancy_file_upload_main').FancyFileUpload({
    url: "{{ route('room.image.main',$room->id) }}",
		params : {
			 _token: $('meta[name="csrf-token"]').attr('content')
		},
		maxfilesize : 1000000,
    edit: true,
	});
});
</script>

<script type="text/javascript">
  $(function() {
	$('#fancy_file_upload_sub').FancyFileUpload({
    url: "{{ route('room.image.sub',$room->id) }}",
		params : {
			 _token: $('meta[name="csrf-token"]').attr('content')
		},
		maxfilesize : 1000000,
    edit: true
	});
});
</script>

{{-- End Fancy File Load --}}

{{-- Alert message for duplicated facilities --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#updateRoomForm').submit(function(event) {
            // Get all selected facility names
            var selectedFacilities = [];
            $('select[name="facility_name[]"]').each(function() {
                var selectedValue = $(this).val();
                if (selectedValue !== '' && selectedFacilities.includes(selectedValue)) {
                    // Display error message for duplicate selection
                    alert('Please select each facility only once.');
                    event.preventDefault(); // Prevent form submission
                    return false;
                }
                selectedFacilities.push(selectedValue);
            });
            return true; // Proceed with form submission
        });
    });
</script>
{{-- End Alert message for duplicated facilities --}}


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

  <!--------===Show MultiImage ========------->

<script>
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
</script>

<!--========== Start of add Basic Plan Facilities ==============-->
<div style="visibility: hidden">
  <div class="whole_extra_item_add" id="whole_extra_item_add">
     <div class="basic_facility_section_remove" id="basic_facility_section_remove">
        <div class="container mt-2 p-0">
           <div class="row">
              <div class="form-group col-md-6">
                <label for="facility_name" class="form-label">Room Facilities </label>
                <select name="facility_name[]" id="basic_facility_name" class="form-control">
                  <option value="" hidden>Select Facility</option>
                  @foreach ($facility as $item)
                  <option value="{{ $item->name }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6 d-flex gap-1" style="padding-top: 30px">
                <span class="btn btn-success addeventmore">
                    <i class="lni lni-circle-plus mx-auto"></i>
                </span>
                <span class="btn btn-danger removeeventmore">
                    <i class="lni lni-circle-minus mx-auto"></i>
                </span>
            </div>
           </div>
        </div>
     </div>
  </div>
</div>

<!--========== Basic Plan Facilities ==============-->
<script type="text/javascript">
  $(document).ready(function(){
     var counter = 0;
     $(document).on("click",".addeventmore",function(){
           var whole_extra_item_add = $("#whole_extra_item_add").html();
           $(this).closest(".add_item").append(whole_extra_item_add);
           counter++;
     });
     $(document).on("click",".removeeventmore",function(event){
           $(this).closest("#basic_facility_section_remove").remove();
           counter -= 1
     });
  });
</script>
<!--========== End of Basic Plan Facilities ==============-->

<!--========== Start Room Number Add  ==============-->
<script>
  $('#roomNoHide').hide();
  $('#roomNoTable').show();
  
  function addRoomNo(){
    $('#roomNoHide').show();
    $('#roomNoTable').hide();
    $('#addRoomNo').hide();

  }


</script>

<!--========== End Room Number Add ==============-->

{{-- Validation For Room Number --}}
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

{{-- End Validation For Room Number --}}

@endsection