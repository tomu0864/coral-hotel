@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
  .modal-body p {
    word-wrap: break-word;
    white-space: pre-wrap; /* Preserve whitespace and wrap lines */
    overflow-wrap: break-word;
  }
  .large-checkbox{
    transform: scale(1.5);
  }
</style>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Comments</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Comments List</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">Comment List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>User Image</th>
              <th>Username</th>
              <th>Post Title</th>
              <th>Time</th>
              <th>Details</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comments as $key => $item)
            @include('backend.modals.admin_modal', ['item' => $item])
              <tr class="align-middle">
                <td>{{ $key + 1 }}</td>
                <td>
                  <img src="{{ $item->user->photo ? $item->user->photo : url('upload/no_image.jpg') }}" alt="{{ $item->user->name }}" style="height: 50px; width: 50px;">
                </td>
                <td>{{ $item->user->name }}</td>
                <td>{{ Str::limit($item->post->post_title, 20) }}</td>
                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal{{ $item->id }}">
                    Details
                  </button>
                </td>
                <td class="text-center ps-4">
                  <div class="form-check-danger form-check form-switch ps-5">
                    <input class="form-check-input  status-toggle large-checkbox d-block" type="checkbox" 
                           id="flexSwitchCheckCheckedDanger" 
                           data-comment-id="{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                  </div>
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

<script>
  $(document).ready(function(){
      $('.status-toggle').on('change', function(){
          var commentId = $(this).data('comment-id');
          var isChecked = $(this).is(':checked');
          // Send an ajax request to update status 
          $.ajax({
              url: "{{ route('comment.status.update') }}",
              method: "POST",
              data: {
                  comment_id: commentId,
                  is_checked: isChecked ? 1 : 0,
                  _token: "{{ csrf_token() }}"
              },
              success: function(response){
                  toastr.success(response.message);
              },
              error: function(){
              }
          }); 
      });
  });
</script>

@endsection