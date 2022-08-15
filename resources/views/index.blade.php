@extends('layouts.admin_master')

@section('css')
    <style>
        .dashboard-cards{
            margin-bottom: 1rem;
        }
        .dashboard-cards .card{
            height: 100%!important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-cards .card h3{
            color: white;
        }

        .dashboard-cards .card p{
            font-size: 1.25rem;
            color: white;
        }

        .card1{
            background: rgb(102, 22, 144);
        }

        .card2{
            background: #575fcf;
        }

        .card3{
            background: rgb(34, 187, 108);
        }

        .card4{
            background: rgb(253, 138, 90)
        }

        .card5{
            background: #B53471;
        }

        .card6{
            background: #006266;
        }

        .card7{
            background: #1289A7;
        }

        .card8{
            background: #833471;
        }

        .card9{
            background: #16a085;
        }

        .card10{
            background: #FF3F45;
        }

        .card11{
            background: #ffc048;
        }

        .card12{
            background: #34495e;
        }

        .text-yellow{
            color: yellow;
        }
    </style>
@endsection

@section('main_content')

    {{-- daily calculations --}}
    <div class="row dashboard-cards">
        <div class="col-md-3">
            <div class="card card1">
                <h3>৳ {{ (int)$today_sell }}</h3>
                <p>Sold In Today</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card2">
                <h3>৳ {{ empty($today_gross_profit->sums) ? 0 : (int)$today_gross_profit->sums}}</h3>
                <p>Purchase In Today</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card3">
                <h3>৳ {{ (int)$today_expenses }}</h3>
                <p>Expense In Today</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card4">
                <h3>৳ {{ (int)$today_net_profit }}</h3>
                <p>Profit In Today</p>
            </div>
        </div>
    </div>

    {{-- monthly calculations --}}
    <div class="row dashboard-cards">
        <div class="col-md-3">
            <div class="card card5">
                <h3>৳ {{ (int)$monthly_sell }}</h3>
                <p>Sold In {{ $current_month_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card6">
                <h3>৳ {{ empty($monthly_gross_profit->sums) ? 0 : (int)$monthly_gross_profit->sums}}</h3>
                <p>Purchase In {{ $current_month_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card7">
                <h3>৳ {{ (int)$monthly_expenses }}</h3>
                <p>Expense In {{ $current_month_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card8">
                <h3>৳ {{ (int)$monthly_net_profit }}</h3>
                <p>Profit In {{ $current_month_name }}</p>
            </div>
        </div>
    </div>

    {{-- yearly calculations --}}
    <div class="row dashboard-cards">
        <div class="col-md-3">
            <div class="card card9">
                <h3>৳ {{ (int)$yearly_sell }}</h3>
                <p>Sold In {{ $current_year }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card10">
                <h3>৳ {{ empty($yearly_gross_profit->sums) ? 0 : (int)$yearly_gross_profit->sums}}</h3>
                <p>Purchase In {{ $current_year }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card11">
                <h3>৳ {{ (int)$yearly_expenses }}</h3>
                <p>Expense In {{ $current_year }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card12">
                <h3>৳ {{ (int)$yearly_net_profit }}</h3>
                <p>Profit In {{ $current_year }}</p>
            </div>
        </div>
    </div>

     {{-- all stock products --}}
     <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card p-2 card-top">
              <div class="d-flex justify-content-between mb-1">
                  <h4><i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i> Product Stock Available </h4>
              </div>
              <table class="example table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                  <tr>
                      <th scope="col">Product</th>
                      <th scope="col">Location</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Current Stock</th>
                      <th scope="col">Current Stock Value <br> <small>(By purchase price)</small></th>
                      <th scope="col">Current Stock Value <br> <small>(By sale price)</small></th>
                      <th scope="col">Potential profit</th>
                      {{-- <th scope="col">Total Unit Sold</th> --}}
                    </tr>
                </thead>
                <tbody id="tableBody" class="text-center">
                    @php
                        $total_quantity = 0;
                        $total_by_purchase = 0;
                        $total_by_sell = 0;
                    @endphp
                    @foreach ($products as $product)
                    @php
                        $sell = $product->quantity * $product->selling_price;
                        $purchase = $product->quantity * $product->inc_purchase_price;
                        $total_quantity +=  $product->quantity;
                        $total_by_purchase += $purchase;
                        $total_by_sell += $sell;
                    @endphp
                      <tr>
                          <td>{{ $product->name }}</td>
                          <td>{{ optional($product->outlet)->name }}</td>
                          <td>{{ $product->selling_price }}TK</td>
                          <td>{{ $product->quantity }}PC</td>
                          <td>{{ $purchase}}TK</td>
                          <td>{{ $sell }}TK</td>
                          <td>{{ $sell - $purchase }}TK</td>
                          {{-- <td>0PC</td> --}}
                      </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                      <tr>
                         <td colspan="3"><b>Total:</b></td>
                         <td><b>{{ $total_quantity }}PC</b></td>
                         <td><b>{{ $total_by_purchase }}TK</b></td>
                         <td><b>{{ $total_by_sell }}TK</b></td>
                         <td><b>{{ $total_by_sell - $total_by_purchase }}TK</b></td>
                         {{-- <td><b>0PC</b></td> --}}
                      </tr>
                </tfoot>
            </table>
            </div>
          </div>
        </div>
    </section> <br> <br>

    {{-- below alert quantity products --}}
    <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card p-2 card-top">
              <div class="d-flex justify-content-between mb-1">
                  <h4><i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i> Product Stock Alert <i class="fa fa-info-circle text-info hover-q no-print" data-bs-toggle="popover" data-bs-content="Products with low stock.Based on product alert quantity set in add product screen.Purchase this products before stock ends" data-bs-placement="bottom" data-bs-trigger="hover"></i></h4>
              </div>
              <table class="example table table-striped table-bordered" style="width:100%">
                  <thead class="text-center">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Current Stock</th>
                      </tr>
                  </thead>
                  <tbody id="tableBody" class="text-center">
                    @foreach ($alerts as $alert)
                        <tr>
                            <td>{{ $alert->name }}</td>
                            <td>{{ $alert->outlet->name }}</td>
                            <td>{{ $alert->quantity }}</td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>
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
