{{-- Modal to edit category --}}

<div class="modal fade" id="categoryModal{{ $item->id }}" tabindex="-1" aria-labelledby="categoryModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('restaurant.category.update', $item->id) }}" method="post">
        <div class="modal-header">
          <h1 class="modal-title fs-6" id="categoryModalLabel{{ $item->id }}">Edit Category</h1>
        </div>
        <div class="modal-body">
          @csrf
          @method('PATCH')
            <label for="name{{$item->id}}" class="form-label">Name</label>
            <input type="text" name="name{{ $item->id }}" class="form-control mb-3 @error('name') is-invalid @enderror" 
            value="{{ old("name$item->id", $item->name) }}" placeholder="Enter category name..." id="name{{$item->id}}">
            @error("name$item->id")
            <p class="text-danger mb-0">{{ $message }}</p>
            @enderror

            <label for="time{{$item->id}}" class="form-label">Time</label>
            <input type="text" name="time{{ $item->id }}" class="form-control @error('time') is-invalid @enderror" 
                   value="{{ old("time$item->id", $item->time) }}" placeholder="ex) 8:00 - 12:00">
            @error("time$item->id")
                <p class="text-danger mb-0">{{ $message }}</p>
            @enderror
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-warning">
              Update
            </button>
          </div>
      </form>
    </div>
  </div>
</div>