@extends('layouts.admin_master')


@section('css')
<style>
    #name-error
    {
        color:red ;
    }
    .bg-primary th{
        color: white!important;
    }

    .filters .col-md-4{
        margin-bottom: 3px;
    }
</style>
@endsection

@section('main_content')

<div class="row">
    <div class="col-12">
        <div class="card p-2 card-top">
            <form action="{{ URL::current() }}" method="get">
                <div class="row filters">
                    <div class="col-md-4">
                        <label for="">From Date</label>
                        <input type="date" class="form-control" name="start_date" placeholder="star">
                    </div>
                    <div class="col-md-4">
                        <label for="">To Date</label>
                        <input type="date" class="form-control" name="end_date" >
                    </div>
                    <div class="col-md-4">
                        <label for="">Invoice No.</label>
                        <input type="text" class="form-control" name="invoice_number" placeholder="invoice_number">
                    </div>
                    <div class="col-md-4">
                        <label for="">Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" placeholder="customer_name">
                    </div>
                    <div class="col-md-4">
                        <label for="">Outlets</label>
                        <select name="outlet" id="" class="form-control">
                            <option value="" selected>Select a outlet</option>
                            @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary" style="margin-right:5px;">Filter</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-success">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th>Invoice</th>
                    <th>Outlet</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
              </thead>
              @php
                  $sl=1;
              @endphp
              <tbody id="tableBody" class="text-center">
                  @foreach ($sales as $sale)
                  <tr>
                     <td>{{ $sl++ }}</td>
                     <td>{{ $sale->invoice_no }}</td>
                     <td>{{ $sale->outlet_name }}</td>
                     <td>{{ $sale->customer_name }}</td>
                     <td>
                        @if ($sale->status == "Paid")
                            <span class="badge bg-primary">{{ $sale->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $sale->status }}</span>
                        @endif
                     </td>
                     <td>{{ $sale->total }}</td>
                     <td>{{ $sale->created_at }}</td>
                     <td>
                        <button class="btn btn-sm btn-success viewBtn" value="{{ $sale->id }}"><i class="fas fa-eye"></i></button>
                        <a href="{{ route('sales.generate',$sale->id) }}" target="_blank" class="btn btn-primary btn-sm text-white">Print</a>
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
</section>

<div class="modal fade text-start" id="myModal" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl d-flex justify-content-center">
      <div class="modal-content" style="width: 90%;">
          <form id="addForm">
          @csrf
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-4 col-lg-4 invoice-col">
                        <b><h4>Invoice No. : <span class="invoice"></span></h4></b>
                        <b><h4>Outlet Name: <span class="outlet"></span></h4> </b>
                        <b><h4>Customer Name: <span class="customer"></span> </h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 invoice-col">
                        <b><h4>Md's Discount : <span class="md_discount"></span></h4></b>
                        <b><h4>Special Discount : <span class="special_discount"></span></h4></b>
                        <b><h4>% Discount : <span class="parcent_discount"></span></h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 invoice-col">
                        <b><h4>Vat : <span class="tax"></span></h4> </b>
                        <b><h4>Total : <span class="total"></span></h4></b>
                        <b><h4>Due : <span class="due"></span></h4></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Product Details:</b></p>
                        <div class="table-responsive mb-3">
                            <table class="table bg-gray">
                                <thead>
                                    <tr class="bg-success">
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="pbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
</div>

@endsection

@section('script')

<script>

$(document).ready(function(){
    $('#example').DataTable({
        scrollX: true,
        "pageLength": 10
    });
});

// view product
$(document).on('click', '.viewBtn', function() {
    $('.pbody').empty();
    var order_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "/sales/" + order_id,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#myModal').modal('show');
            $('.invoice').text(response[0].invoice_no);
            $('.outlet').text(response[0].outlet_name);
            $('.customer').text(response[0].customer_name);
            $('.md_discount').text(response[0].md_discount);
            $('.special_discount').text(response[0].special_discount);
            $('.parcent_discount').text(response[0].parcent_discount);
            $('.tax').text(response[0].vat);
            $('.total').text(response[0].total);
            $('.due').text(response[0].due_amount);

            // products
            var s = "";
            $(response).each(function( index,value ) {
               s += `<tr>
                    <td>
                        <span class="name"></span>${value.product_name}<span></span>
                    </td>
                    <td>
                        <span class="qty"></span><span>${value.qty}</span>
                    </td>
                    <td>
                        <span class="price"></span><span>${value.price}Tk</span>
                    </td>
                    <td>
                        <span class="subtotal"></span><span>${value.qty * value.price}Tk</span>
                    </td>
                </tr>`
            });

            $('.pbody').append(s);
        }
    });
});

</script>

@endsection


