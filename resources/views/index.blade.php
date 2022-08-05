@extends('layouts.admin_master')

@section('css')
    <style>
        .card{
            height: 100%!important;
        }

        .text-yellow{
            color: yellow;
        }
    </style>
@endsection

@section('main_content')
    {{-- daily calculations --}}
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header" >
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $today_sell }}</h2>
                <p class="card-text">Today Sold</p>
              </div>
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $today_gross_profit->sums }}</h2>
                <p class="card-text">Today Gross Profit</p>
              </div>
              <div class="avatar bg-light-success p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $today_expenses }}</h2>
                <p class="card-text">Today Expenses</p>
              </div>
              <div class="avatar bg-light-danger p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">{{ $today_net_profit }}</h2>
                <p class="card-text">Totday Net Profit</p>
              </div>
              <div class="avatar bg-light-warning p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon font-medium-5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- monthly calculations --}}
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header" >
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ (int)$monthly_sell }}</h2>
                <p class="card-text">Sold In {{ $current_month_name }}</p>
              </div>
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $monthly_gross_profit->sums }}</h2>
                <p class="card-text">Gross Profit {{ $current_month_name }}</p>
              </div>
              <div class="avatar bg-light-success p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $monthly_expenses }}</h2>
                <p class="card-text">Expense In {{ $current_month_name }}</p>
              </div>
              <div class="avatar bg-light-danger p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $monthly_net_profit }}</h2>
                <p class="card-text">Monthly Net Profit</p>
              </div>
              <div class="avatar bg-light-warning p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon font-medium-5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- yearly calculations --}}
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header" >
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ (int)$yearly_sell }}</h2>
                <p class="card-text">Sold In This Year</p>
              </div>
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu font-medium-5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $yearly_gross_profit->sums }}</h2>
                <p class="card-text">Gross Profit This Year</p>
              </div>
              <div class="avatar bg-light-success p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server font-medium-5"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $yearly_expenses }}</h2>
                <p class="card-text">Expenses This Year</p>
              </div>
              <div class="avatar bg-light-danger p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity font-medium-5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <div>
                <h2 class="fw-bolder mb-0">৳ {{ $yearly_net_profit }}</h2>
                <p class="card-text">Yearly Net Profit</p>
              </div>
              <div class="avatar bg-light-warning p-50 m-0">
                <div class="avatar-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon font-medium-5"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
              </div>
            </div>
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
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                  <tr>
                      <th scope="col">Product</th>
                      <th scope="col">Location</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Current Stock</th>
                      <th scope="col">Current Stock Value <br> <small>(By purchase price)</small></th>
                      <th scope="col">Current Stock Value <br> <small>(By sale price)</small></th>
                      <th scope="col">Potential profit</th>
                      <th scope="col">Total Unit Sold</th>
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
                          <td>0PC</td>
                      </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                      <tr>
                         <td colspan="2"><b>Total:</b></td>
                         <td><b>{{ $total_quantity }}PC</b></td>
                         <td><b>{{ $total_by_purchase }}TK</b></td>
                         <td><b>{{ $total_by_sell }}TK</b></td>
                         <td><b>{{ $total_by_sell - $total_by_purchase }}TK</b></td>
                         <td><b>0PC</b></td>
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
              <table id="example" class="table table-striped table-bordered" style="width:100%">
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
        $('#example').DataTable({
            scrollX: true,
            "pageLength": 10
        });
    });

</script>

@endsection
