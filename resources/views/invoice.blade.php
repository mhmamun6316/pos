<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>General Invoice - Rakhi Electronics</title>
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
======================= -->
<!-- Stylesheet
======================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
  <div class="row align-items-center">
    <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
      {{-- <img id="logo" src="images/logo.png" title="Koice" alt="Koice" /> --}}
    </div>
    <div class="col-sm-5 text-center text-sm-end">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  </header>

  <!-- Main Content -->
  <main>
  <div class="row">
    <div class="col-md-6"><strong>Date:</strong> {{ $date }}</div>
    <div class="col-md-6 text-sm-end"> <strong>Invoice No:</strong> {{ $sales[0]->invoice_no }}</div>

  </div>
  <hr>
  <div class="row">
    <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
      <address>
      Rakhi Electronics<br />
      Chuadanga<br />
      rakhi@gmail.com
      </address>
    </div>
    <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
      <address>
        {{ $sales[0]->name }}<br />
        {{ $sales[0]->address }}<br />
        {{ $sales[0]->mobile_number }} <br />
        {{ $sales[0]->email }}
      </address>
    </div>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0">
		<thead class="card-header">
          <tr>
            <td class="col-2 text-center"><strong>SL</strong></td>
            <td class="col-4 text-center"><strong>Name</strong></td>
            <td class="col-4 text-center"><strong>Price</strong></td>
			<td class="col-2 text-center"><strong>QTY</strong></td>
            <td class="col-2 text-center"><strong>Amount</strong></td>
          </tr>
        </thead>
          <tbody>
            @php
                $sl = 1;
            @endphp
            @foreach ($sales as $sale)
                <tr>
                    <td class="col-2 text-center"><strong>{{ $sl++ }}</strong></td>
                    <td class="col-4 text-center"><strong>{{ $sale->product_name }}</strong></td>
                    <td class="col-2 text-center"><strong>{{ $sale->price }}Tk</strong></td>
                    <td class="col-2 text-center"><strong>{{ $sale->qty }}</strong></td>
                    <td class="col-2 text-center"><strong>{{ $sale->price * $sale->qty}}Tk</strong></td>
                </tr>
            @endforeach
          </tbody>

		  <tfoot class="card-footer">
			<tr>
              <td colspan="4" class="text-end"><strong>Sub Total:</strong></td>
              <td class="text-end">$2150.00</td>
            </tr>
            <tr>
              <td colspan="4" class="text-end"><strong>Tax:</strong></td>
              <td class="text-end">$215.00</td>
            </tr>
			<tr>
              <td colspan="4" class="text-end border-bottom-0"><strong>Total:</strong></td>
              <td class="text-end border-bottom-0">{{ $sales[0]->total }}Tk</td>
            </tr>
		  </tfoot>
        </table>
      </div>
    </div>
  </div>
  </main>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
