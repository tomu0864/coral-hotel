@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Report</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Booking Report By Date</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
     <a href="{{ route('booking.report') }}" class="btn btn-primary px-5 radius-30">
      Search Booking Report
     </a>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">{{ date('Y/m/d', strtotime($start_date)) }} ~ {{ date('Y/m/d', strtotime($end_date)) }}</h6>
  <hr/>
  <h5 class="mb-3">Total Sales: $<u>{{ number_format($total_earnings, 2) }}</u></h5>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>SI</th>
              <th>Booking No.</th>
              <th>Guest Name</th>
              <th>Email</th>
              <th>Payment Mehod</th>
              <th>Total Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bookings as $key => $item)
                
            <tr class="align-middle">
              <td>{{ $key+1 }}</td>
              <td>{{ $item->code }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->payment_method}}</td>
              <td>$ {{ number_format($item->total_price, 2) }}</td>  
              <td class="text-center">
                <a href="{{ route('booking.download.invoice', $item->id) }}" class="btn btn-warning px-3 radius-10 ms-1">
                  <i class='bx bx-download'></i> Download Invoice
                </a>
              </td>
            </tr>
            @endforeach
     
          </tbody>
         
        </table>
      </div>
    </div>
  </div>
 
  <!-- Add the chart below the table -->
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Booking Overview</h5>
      <canvas id="bookingChart"></canvas>
    </div>
  </div>

</div>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
              label: 'Total Sales',
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
