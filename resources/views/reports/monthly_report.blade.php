@extends('layouts.admin_master')

@section('css')
<style>
    .error
    {
        color:red!important ;
    }
</style>
@endsection

@section('main_content')

<h1 class="header-title">
    <strong>Monthly Report</strong>
</h1>

<div class="row">

    <div class="col-md-3">
         <div class="card card-body bg-success">
              <h6 class="text-white text-uppercase">Sale Amount</h6>
              <p class="fs-18 fw-700 text-white">৳ {{ $monthly_sell }}</p>
         </div>
    </div>
    <div class="col-md-3">
         <div class="card card-body bg-danger">
              <h6 class="text-white text-uppercase">Purchase Cost</h6>
              <p class="fs-18 fw-700 text-white">৳ {{ $purchase_cost->sums }}</p>
         </div>
    </div>
    <div class="col-md-3">
         <div class="card card-body bg-dark">
              <h6 class="text-white text-uppercase">Expense Amount</h6>
              <p class="fs-18 fw-700 text-white">৳ {{ $monthly_expenses }}</p>
         </div>
    </div>
    <div class="col-md-3">
         <div class="card card-body bg-primary">
              <h6 class="text-white text-uppercase">Sell Profit</h6>
              <p class="fs-18 fw-700 text-white">৳ {{ $monthly_profit }}
              </p>
         </div>
    </div>

</div>

<div class="row" >
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
             <div class="card-header bg-primary d-flex justify-between">
                  <h5 class="card-title text-white"><strong>Monthly Sell Products</strong></h5>
                  <a class="btn btn-success" target="blank" href="{{ route('monthly.sell.product') }}">PRINT</a>
             </div>

             <div class="card-body">
                <table class="example table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                      <tr>
                          <th>Outlet</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="text-center">
                        @foreach ($monthly_sell_products as $item)
                            <tr>
                                <td>{{ $item->outlet_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->selling_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header bg-danger d-flex justify-between">
                <h5 class="card-title text-white"><strong>Monthly Expenses</strong></h5>
                <a class="btn btn-success" target="blank" href="{{ route('monthly.expenses') }}">PRINT</a>
           </div>

             <div class="card-body">
                <table class="example table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                      <tr>
                          <th>Outlet</th>
                          <th>Expense</th>
                          <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="text-center">
                        @foreach ($monthly_expenses_datas as $item)
                            <tr>
                                <td>{{ $item->outlet_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
             <div class="card-header bg-success">
                  <h5 class="card-title text-white"><strong>Monthly Customer Pays</strong></h5>
             </div>

             <div class="card-body">
                <table class="example table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                      <tr>
                          <th>Customer Name</th>
                          <th>Amount</th>
                          <th>Note</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="text-center">
                        @foreach ($monthly_due_pays as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>323</td>
                                <td>{{ $item->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>

</div>

@endsection

@section('script')
    <script>
           $(document).ready(function(){
                $('.example').DataTable({
                    scrollX: true,
                    "pageLength": 10
                });
            });
    </script>
@endsection
