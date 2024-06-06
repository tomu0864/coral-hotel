<div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="exampleModalLabel">No.{{ $u_booking->code }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to cancel your booking?</h5>
      </div>
      <div class="modal-footer border-0">
        <form action="{{ route('booking.cancel', $u_booking->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-warning fw-bold">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>