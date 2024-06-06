{{-- Modal to show Contact message --}}

<div class="modal fade" id="faqModal{{ $item->id }}" tabindex="-1" aria-labelledby="faqModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="faqModalLabel{{ $item->id }}">{{ $item->question }}</h1>
      </div>
      <div class="modal-body">
        <p>{{ $item->answer }}</p>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>