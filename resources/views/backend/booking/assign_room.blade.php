
<table class="table">
  <thead>
    <tr>
      <th>Room Number</th>
      <th>Action</th>
    </tr>
  </thead>
  
  <tbody>

    @foreach ($room_numbers as $room_number)
    <tr>
      <td>{{ $room_number->room_no }}</td>  
      <td>
        <form action="{{ route('booking.assign.room.store', [$booking->id, $room_number->id]) }}" method="post">
          @csrf
          <button class="btn btn-primary">
            <i class="lni lni-circle-plus ps-1"></i>
          </button>
          </td>  
        </form>   
      </tr>        
      @endforeach
    </tbody>
  </table>