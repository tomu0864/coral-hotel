@extends('frontend.main')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg6">
          <div class="container">
              <div class="inner-title">
                  <ul>
                      <li>
                          <a href="index.html">Home</a>
                      </li>
                      <li><i class='bx bx-chevron-right'></i></li>
                      <li>Booking Details</li>
                  </ul>
                  <h3>Booking Details</h3>
              </div>
          </div>
      </div>
      <!-- Inner Banner End -->

      <!-- Service Details Area -->
      <div class="service-details-area pt-100 pb-70">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              {{-- Sidebar --}}
              @include('frontend.dashboard.user_menu')
              {{-- End Sidebar --}}
            </div>

            <div class="col-lg-9">
              <div class="service-article">
                <section class="checkout-area pb-70">
                  <div class="container">
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <div class="billing-details">
                            <div class="page-content">
                              <h6 class="mb-0 text-uppercase">Booking List</h6>
                              <hr/>
                              <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                      <thead>
                                        <tr>
                                          <th>Booking No.</th>
                                          <th>Booking Date</th>
                                          <th>Room Type</th>
                                          <th>Check In/Out</th>
                                          <th>Total</th>
                                          <th>Number of Guest</th>
                                          <th>Status</th>
                                          <th>Cancel</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($u_bookings as $u_booking)
                                        <tr class="align-middle">
                                            <td>
                                              <a href="{{ route('user.booking.invoice', $u_booking->id) }}">
                                                {{ $u_booking->code }}
                                              </a>
                                            </td>
                                          <td>{{ $u_booking->created_at->format('Y/m/d') }}</td>
                                          <td>{{ $u_booking->room->type->name }}</td>
                                          <td><span class="badge bg-primary">{{ $u_booking->check_in }}</span><br>
                                            <span class="badge bg-warning">{{ $u_booking->check_out }}</span></td>
                                          <td>{{ $u_booking->number_of_rooms }}</td> 
                                          <td>{{ $u_booking->person }}</td>
                                          <td class="text-center">
                                            @if ($u_booking->status == '1')
                                              <span class="badge bg-danger">Booked</span>
                                            @else
                                            <span class="badge bg-success">Completed</span>
                                            @endif
                                          </td>

                                          @php
                                            $checkInDate = Carbon\Carbon::parse($u_booking->check_in);
                                            $today = Carbon\Carbon::today();
                                            $isWithinThreeDays = $checkInDate->diffInDays($today, false) <= 3 && $today->lte($checkInDate);
                                          @endphp

                                              <td>
                                                  @if ($isWithinThreeDays)
                                                    <p class="text-danger mb-0 small">Your check-in date is within 3 days. Please contact us directly.</p>
                                                  @else
                                                   @if ($u_booking->status == '1')
                                                   <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cancelBookingModal">
                                                      Cancel
                                                    </button>
                                                   @endif
                                                  @endif
                                              </td>
                                        </tr>         
                                        
                                        @include('frontend.dashboard.modals.delete_booking')
                                        @endforeach
                                                          
                                      </tbody>
                                     
                                    </table>
                                  </div>
                                </div>
                              </div>
                             
                              {{-- <hr/> --}}
                            
                            </div>
                        </div>
                      </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Service Details Area End -->

@endsection