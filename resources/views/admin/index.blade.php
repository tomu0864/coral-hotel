@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
  use App\Models\Booking;
  use Carbon\Carbon;

  // Define the current date
  $today = Carbon::now();

  // Bookings
  $bookings = App\Models\Booking::latest()->get();
  $ongoing_bookings = Booking::where('status', '1')
    ->whereDate('check_in', '>=', $today)
    ->orderBy('check_in', 'asc')
    ->take(10)->get();

  $completed_bookings  = App\Models\Booking::latest()->where('status', '2')->get();
  $total_earnings = App\Models\Booking::sum('total_price');

  $todayPrice = App\Models\Booking::whereDate('created_at', $today)->sum('total_price');
  
  // Today's sales
  $todaySales = Booking::whereDate('created_at', $today)->sum('total_price');
  $todayLastYearSales = Booking::whereDate('created_at', $today->copy()->subYear())->sum('total_price');
  $todaySalesPercentage = $todayLastYearSales > 0 ? (($todaySales - $todayLastYearSales) / $todayLastYearSales) * 100 : ($todaySales > 0 ? 100 : 0);

  // This week's sales
  $startOfWeek = $today->copy()->startOfWeek();
  $endOfWeek = $today->copy()->endOfWeek();
  $thisWeekSales = Booking::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_price');
  $startOfWeekLastYear = $startOfWeek->copy()->subYear();
  $endOfWeekLastYear = $endOfWeek->copy()->subYear();
  $thisWeekLastYearSales = Booking::whereBetween('created_at', [$startOfWeekLastYear, $endOfWeekLastYear])->sum('total_price');
  $thisWeekSalesPercentage = $thisWeekLastYearSales > 0 ? (($thisWeekSales - $thisWeekLastYearSales) / $thisWeekLastYearSales) * 100 : ($thisWeekSales > 0 ? 100 : 0);

  // This month's sales
  $startOfMonth = $today->copy()->startOfMonth();
  $endOfMonth = $today->copy()->endOfMonth();
  $thisMonthSales = Booking::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');
  $startOfMonthLastYear = $startOfMonth->copy()->subYear();
  $endOfMonthLastYear = $endOfMonth->copy()->subYear();
  $thisMonthLastYearSales = Booking::whereBetween('created_at', [$startOfMonthLastYear, $endOfMonthLastYear])->sum('total_price');
  $thisMonthSalesPercentage = $thisMonthLastYearSales > 0 ? (($thisMonthSales - $thisMonthLastYearSales) / $thisMonthLastYearSales) * 100 : ($thisMonthSales > 0 ? 100 : 0);

  // This year's sales
  $startOfYear = $today->copy()->startOfYear();
  $endOfYear = $today->copy()->endOfYear();
  $thisYearSales = Booking::whereBetween('created_at', [$startOfYear, $endOfYear])->sum('total_price');
  $startOfYearLastYear = $startOfYear->copy()->subYear();
  $endOfYearLastYear = $endOfYear->copy()->subYear();
  $thisYearLastYearSales = Booking::whereBetween('created_at', [$startOfYearLastYear, $endOfYearLastYear])->sum('total_price');
  $thisYearSalesPercentage = $thisYearLastYearSales > 0 ? (($thisYearSales - $thisYearLastYearSales) / $thisYearLastYearSales) * 100 : ($thisYearSales > 0 ? 100 : 0);
@endphp
  
<div class="page-content">

    {{-- Sales --}}
 
 <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
  <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-info">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">Today's Sales</p>
            <h4 class="my-1 text-info">${{ number_format($todaySales, 2) }}</h4>
            <p class="mb-0 font-13 small">Compared to same day last year: {{ number_format($todaySalesPercentage, 2) }}%</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-danger">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">This Week's Sales</p>
            <h4 class="my-1 text-danger">${{ number_format($thisWeekSales, 2) }}</h4>
            <p class="mb-0 font-13 small">Compared to same week last year: {{ number_format($thisWeekSalesPercentage, 2) }}%</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-success">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">This Month's Sales</p>
            <h4 class="my-1 text-success">${{ number_format($thisMonthSales, 2) }}</h4>
            <p class="mb-0 font-13 small">Compared to same month last year: {{ number_format($thisMonthSalesPercentage, 2) }}%</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-warning">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">This Year's Sales</p>
            <h4 class="my-1 text-warning">${{ number_format($thisYearSales, 2) }}</h4>
            <p class="mb-0 font-13 small">Compared to last year: {{ number_format($thisYearSalesPercentage, 2) }}%</p><br>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!--End sales-->

  {{-- Bookings --}}
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
             <div class="col">
     <div class="card radius-10 border-start border-0 border-4 border-info">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <p class="mb-0 text-secondary">Total Booking</p>
            <h4 class="my-1 text-info">{{ $bookings->count() }}</h4>
          </div>
          <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bx-calendar-star' ></i>
          </div>
        </div>
      </div>
     </div>
     </div>
     <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-danger">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Ongoing Booking</p>
             <h4 class="my-1 text-danger">{{ $ongoing_bookings->count() }}</h4>
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bx-calendar-x'></i></i>
           </div>
         </div>
       </div>
    </div>
    </div>
    <div class="col">
    <div class="card radius-10 border-start border-0 border-4 border-success">
       <div class="card-body">
         <div class="d-flex align-items-center">
           <div>
             <p class="mb-0 text-secondary">Completed Booking</p>
             <h4 class="my-1 text-success">{{ $completed_bookings->count() }}</h4>
           </div>
           <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bx-calendar-check'></i>
           </div>
         </div>
       </div>
    </div>
    </div>
  </div>
  <!--end booking-->
  

 {{-- Chart --}}
  <div class="row">
   <div class="col-12 col-lg-12 d-flex">
    <div class="card radius-10 w-100">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <div>
            <h6 class="mb-0">Bookings Overview</h6>
          </div>
        </div>
      </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
      
        <canvas id="bookingChart"></canvas>

        </div>
      </div>
     </div>
  </div>
  <!--End Chart-->

   <div class="card radius-10">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <div>
          <h6 class="mb-0">Upcoming Bookings</h6>
        </div>
      </div>
    </div>
      <div class="card-body">
       <div class="table-responsive">
         <table class="table align-middle mb-0">
        <thead class="table-light">
         <tr>
           <th>SI</th>
           <th>Booking No.</th>
           <th>Booking Date</th>
           <th>Customer</th>
           <th>Room</th>
           <th>Check In/Out</th>
           <th>Total Room</th>
           <th>Guest</th>
           <th>Payment</th>
         </tr>
         </thead>
         <tbody>
          @foreach ($ongoing_bookings as $key => $booking)
            
          <tr>
            <td>{{ $key+1 }}</td>
          <td><a href="{{ route('booking.edit', $booking->id )}} ">{{ $booking->code }}</a></td>
          <td>{{ $booking->created_at }}</td>
          <td>{{ $booking->user->name }}</td>
          <td>{{ $booking->room->type->name }}</td>
          <td>
            <span class="badge rounded-pill bg-secondary">
              {{ date('Y-m-d', strtotime($booking->check_in)) }}
            </span>
                to
            <span class="badge rounded-pill bg-info text-dark">
               {{ date('Y-m-d', strtotime($booking->check_out)) }}
          </td>
          <td>{{ $booking->number_of_rooms}}</td>
          <td>{{ $booking->person}}</td>
          <td>
            @if ($booking->payment_status == '1')
            <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
            @else
            <span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>      
            @endif
          </td>
        </tr>
        @endforeach

          </tbody>
        </table>
        </div>
       </div>
    </div>
</div>

<script>
  var ctx = document.getElementById('bookingChart').getContext('2d');
  var bookings = @json($bookings);

  // Sort the bookings by check_in date
  bookings.sort(function(a, b) {
      return new Date(a.check_in) - new Date(b.check_in);
  });

  // Extract the required data from the sorted bookings
  var labels = bookings.map(function(booking) {
      return booking.check_in; 
  });

  var data = bookings.map(function(booking) {
      return booking.total_price;
  });

  var bookingChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: 'Booking Data',
              data: data,
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>

@endsection
