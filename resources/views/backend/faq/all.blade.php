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
    <div class="breadcrumb-title pe-3">FAQ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">FAQ List</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <a href="{{ route('faq.add') }}" class="btn btn-primary px-5 radius-30">
      Add FAQ
     </a>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">FAQ List</h6>
  <hr/>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Question</th>
              <th>Answer</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($faqs as $key => $item)
            @include('backend.modals.faq', ['item' => $item])
              <tr class="align-middle">
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->question }}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faqModal{{ $item->id }}">
                    Details
                  </button>
                </td>
                <td>
                  <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                  <form action="{{ route('faq.delete', $item->id) }}" id="deleteFaq{{ $item->id }}" method="post" class="deleteFaq d-inline">
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