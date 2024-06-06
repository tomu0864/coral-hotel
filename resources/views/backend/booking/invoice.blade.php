<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css"> 
 body{margin-top:20px;
}
#invoice {
    padding: 0px;
}

.invoice {
    position: relative;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 10px;
    margin-bottom: 20px;
    border-bottom: 1px solid #ce5e3c;
    background-color: #1b2132;
    color: #fff
    
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #ce5e3c
}

.invoice main {
    padding-bottom: 50px
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,
.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

.invoice table tfoot tr:last-child td {
    color: #ce5e3c;
    font-size: 1.4em;
    border-top: 1px solid #ce5e3c
}

.invoice table tfoot tr td:first-child {
    border: none
}

@media print {
    .invoice {
        font-size: 11px !important;
        overflow: hidden !important
    }
    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }
    .invoice>div:last-child {
        page-break-before: always
    }
}

.authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #ce5e3c;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: #ce5e3c;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <div class="container">
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                  {{-- <img src="{{ asset('backend/assets/images/logo-icon.png') }}" alt=""> --}}
                                </div>
                                <div class="col company-details">
                                    <h2 class="name" style="margin-bottom:10px;">
									    <span style="color: #b56952;">Coral </span>HOTEL
                                    </h2>
                                    <div>La Victoria Street, Lapu-Lapu, Cebu</div>
                                    <div>(123) 456-789</div>
                                    <div>coral@example.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $booking->name }}</h2>
                                    <div class="address">{{ $booking->address }}</div>
                                    <div class="email">{{ $booking->email }}
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">#{{ $booking->code }}</h1>
                                    <div class="date">Date of booking: {{ $booking->created_at->format('Y/m/d') }}</div>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Room Type</th>
                                        <th>Total Room</th>
                                        <th>Room Price</th>
                                        <th>Check In/Out</th>
                                        <th>Total Nights</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $booking->room->type->name }}</td>
                                        <td>{{ $booking->number_of_rooms }}</td>
                                        <td>$ {{ number_format($booking->room->price, 2) }}</td>
                                        <td>{{ $booking->check_in }} <br>
                                            {{ $booking->check_out }}
                                        </td>
                                        <td>{{ $booking->total_night }} Nights</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>${{ number_format($booking->sub_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">DISCOUNT</td>
                                        <td>${{ number_format($booking->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>${{ number_format($booking->total_price, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks mt-3">
                              <p>Thanks For Your Booking..!!</p>
                            </div>
                            <div class="authority float-right mt-5">
                                <p>-----------------------------------</p>
                                <h5>Authority Signature:</h5>
                              </div>
                        </main>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>