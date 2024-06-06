@extends('frontend.main')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <!-- Inner Banner -->
  <div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Room Details </li>
            </ul>
            <h3>{{ $room->type->name }}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Room Details Area End -->
<div class="room-details-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form action="{{ route('booking.store', $room->id) }}" method="post" id="bk_form">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                          <input type="text" name="check_in" id="check_in" value="{{ old('check_in') }}" class="form-control dt_picker" 
                                          autocomplete="off" placeholder="yyyy-mm-dd" required>
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                          <input type="text" name="check_out" id="check_out" value="{{ old('check_out') }}" class="form-control dt_picker" 
                                          autocomplete="off" placeholder="yyyy-mm-dd" required>
                                          <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control" name="person" id="nmbr_person">
                                            @for ($i = 1; $i <= 4; $i++)
                                            <option value="0{{ $i }}" {{ old('person') == $i ? 'selected' : ''}}
                                            >0{{ $i }}</option>
                                            @endfor

                                        </select>	
                                    </div>
                                    
                                </div>
                                
                                <input type="hidden" id="total_adult" name="total_adult" value="{{ $room->total_adult }}">
                                <input type="hidden" id="room_price" name="room_price" value="{{ $room->price }}">
                                <input type="hidden" id="discount" name="discount" value="{{ $room->discount }}">
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <input type="hidden" name="available_room" id="available_room">
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control" name="number_of_rooms" id="select_room">
                                            @for ($i = 1; $i <= 5; $i++)
                                            <option value="0{{ $i }}">0{{ $i }}</option>
                                            @endfor
                                        </select>	
                                    </div>
                            
                                    <p class="available_room"></p>
                                </div>

                                <div class="col-lg-12">
                                    <table class="table">
                                        <tbody>
                                          <tr>
                                            <td><p class="mb-0">Total Nights</p></td>
                                            <td><p class="mb-0 text-end"><span class="total_night"> 0</span></p></td>
                                          </tr>
                                          <tr>
                                            <td><p class="mb-0">Basic Price</p></td>
                                            <td><p class="mb-0 text-end">$ <span class="basic_price">0</span></p></td>
                                          </tr>
                                          <tr>
                                            <td><p class="mb-0">Discount</p></td>
                                            <td><p class="mb-0 text-end">$ <span class="discount">0</span></p></td>
                                          </tr>
                                          <tr>
                                            <td><p class="mb-0">Total Price</p></td>
                                            <td><p class="mb-0 text-end">$ <span class="total_price">0</span></p></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
    
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                  
                </div>
            </div>

            <div class="col-lg-8">
                <div class="room-details-article">
                    <div class="room-details-slider owl-carousel owl-theme">
                      @foreach ($multiImgs as $img)
                      <div class="room-details-item">
                          <img src="{{ asset('upload/rooming/multi_img/' .$img->multi_img) }}" alt="{{ $room->type->name }} Image">
                      </div>                        
                      @endforeach
                    </div>

                    <div class="room-details-title">
                        <h2>{{ $room->type->name }}</h2>
                        <ul>
                            
                            <div class="rating-all-room text-color">
                        
                                @for ($i = 0; $i < $room->averageRating(); $i++ )
                                  <i class='bx bxs-star'></i>
                                @endfor

                                @if ($room->ratings->count() > 0)
                                   <a href="#clients-review" class="h6 align-items-end" style="color: #ee786c;"> <i class='bx bx-chevron-down'></i>
                                    {{ $room->ratings->count() }}  
                                   </a>
                                @endif
       
                            </div>

                            <li>
                               <b> Basic : ${{ $room->price }}/Night/Room</b>
                            </li> 
                         
                        </ul>
                    </div>

                    <div class="room-details-content">
                      <p>
                        {!! $room->description !!}
                      </p>


                    <div class="side-bar-plan">
                        <h3>Facilities</h3>
                        <ul>
                          @foreach ($facilities as $facility)
                          <li><a href="#">{{ $facility->facility_name }}</a></li>   
                          @endforeach
                        </ul>              
                    </div>

        <div class="row"> 
        <div class="col-lg-6">

        <div class="services-bar-widget">
                                <h3 class="title">Size</h3>
        <div class="side-bar-list">
            <ul>
              <li>
                    <a href="#"> <b>Capacity : </b> {{ $room->total_adult }} Person <i class='bx bxs-cloud-download'></i></a>
                </li>
                <li>
                    <a href="#"> <b>Size : </b> {{ $room->size }} <i class='bx bxs-cloud-download'></i></a>
                </li>           
            </ul>
        </div>
      </div>
    </div>



        <div class="col-lg-6">
        <div class="services-bar-widget">
        <h3 class="title">View & Bed Style</h3>
        <div class="side-bar-list">
            <ul>
              <li>
                    <a href="#"> <b>View : </b> {{ $room->view }} <i class='bx bxs-cloud-download'></i></a>
                </li>
                <li>
                    <a href="#"> <b>Bad Style : </b> {{ $room->bed_style }} <i class='bx bxs-cloud-download'></i></a>
                </li>
                
            </ul>
        </div>
        </div> 
            </div> 
                </div>
                    </div>

                   @include('frontend.room.partials.review')

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details Area End -->

<!-- Room Details Other -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Our Other rooms</h2>
        </div>

        @include('frontend.room.partials.other_room')
        
    </div>
</div>


<!-- Room Details Other End -->

<!-- Existing Script for Price Calculation and Availability -->

<script>

$(document).ready(function () {
    var check_in = $("#check_in").val();
    var check_out = $("#check_out").val();
    var room_id = "{{ $room->id }}";

    if (check_in != '' && check_out != '') {
        getAvailability(check_in, check_out, room_id);
    }

    $("#check_out").on('change', function () {
        var check_out = $(this).val();
        var check_in = $("#check_in").val();

        if (check_in != '' && check_out != '') {
            getAvailability(check_in, check_out, room_id);
        }
    });

    $("#select_room").on('change', function () {
        var check_out = $("#check_out").val();
        var check_in = $("#check_in").val();

        if (check_in != '' && check_out != '') {
            getAvailability(check_in, check_out, room_id);
        }
    });
});

function getAvailability(check_in, check_out, room_id) {
    $.ajax({
        url: "{{ route('room.availability') }}",
        data: { room_id: room_id, check_in: check_in, check_out: check_out },
        success: function (data) {
            $(".available_room").html('Availability: <span class="text-success">' + data['available_room'] + ' Rooms</span>');
            $("#available_room").val(data['available_room']);

            // Calculate total nights
            var toDate = new Date(check_out);
            var fromDate = new Date(check_in);
            var total_nights = Math.ceil((toDate - fromDate) / (1000 * 60 * 60 * 24));

            // Update total nights display
            $(".total_night").text(total_nights);
            $("#total_night").val(total_nights);

            // Recalculate prices based on room selection
            price_calculate(total_nights);
        }
    });
}

function price_calculate(total_nights) {
    var check_in = document.getElementById('check_in').value;
    var check_out = document.getElementById('check_out').value;

    // Parse the dates
    var fromDate = new Date(check_in);
    var toDate = new Date(check_out);

    // Calculate total nights
    var nights = (toDate - fromDate) / (1000 * 60 * 60 * 24);

    // Check if nights is not positive
    if (nights <= 0) {
        nights = 0; // Set total nights to zero
    }

    // Update displayed total nights
    document.querySelector('.total_night').textContent = Math.ceil(nights);

    // Perform price calculation if nights is positive
    if (nights > 0) {
        var room_price = parseFloat(document.getElementById('room_price').value);
        var discount_percent = parseFloat(document.getElementById('discount').value);
        var select_room = parseInt(document.getElementById('select_room').value);

        var sub_total = room_price * nights * select_room;
        var discount_amount = (discount_percent / 100) * sub_total;
        var total_price = sub_total - discount_amount;

        // Update displayed prices
        document.querySelector('.basic_price').textContent = sub_total.toFixed(2);
        document.querySelector('.discount').textContent = discount_amount.toFixed(2);
        document.querySelector('.total_price').textContent = total_price.toFixed(2);
    } else {
        // Set prices to zero if nights is not positive
        document.querySelector('.basic_price').textContent = '0.00';
        document.querySelector('.discount').textContent = '0.00';
        document.querySelector('.total_price').textContent = '0.00';
    }
}


document.addEventListener('DOMContentLoaded', function () {
    var errorMessageContainer = document.getElementById('error-message-container');
    var errorMessageText = document.getElementById('error-message-text');

    // Initially hide the error message container
    errorMessageContainer.style.display = 'none';

    document.getElementById('bk_form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form submission for now

        var check_in = document.getElementById('check_in').value;
        var check_out = document.getElementById('check_out').value;
        var selected_rooms = parseInt(document.getElementById('select_room').value);
        var available_rooms = parseInt(document.getElementById('available_room').value);
        var selected_persons = parseInt(document.getElementById('nmbr_person').value);
        var total_adults = parseInt(document.getElementById('total_adult').value);

        var errors = [];

        // Check-in and Check-out validation
        if (check_in >= check_out) {
            errors.push("Check-out date must be after check-in date!");
        }

        // Number of selected rooms validation
        if (selected_rooms > available_rooms) {
            errors.push("Sorry, you have selected more rooms than available!");
        }

        // Number of selected persons validation
        if (selected_persons > total_adults) {
            errors.push("Sorry, you have selected more persons than allowed!");
        }

        // Display errors if any
        if (errors.length > 0) {
            var errorMessage = errors.join("<br>");
            showError(errorMessage);
            return; // Exit without submitting the form
        }

        // If no errors, proceed with form submission
        this.submit();
    });

    function showError(message) {
        // Set error message content
        errorMessageText.innerHTML = message;

        // Show error message container
        errorMessageContainer.style.display = 'flex';

        // Automatically hide error message after 5 seconds (5000 milliseconds)
        setTimeout(function () {
            hideError();
        }, 7000); // Adjust the timeout as needed
    }

    function hideError() {
        // Hide error message container
        errorMessageContainer.style.display = 'none';
    }
});

</script>


@endsection