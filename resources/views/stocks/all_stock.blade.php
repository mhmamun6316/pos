@extends('layouts.admin_master')


@section('css')
<style>
    #name-error
    {
        color:red ;
    }
    .buttons button{
        margin-bottom: 4px;
    }
    .bg-primary th{
        color: white!important;
    }
</style>
@endsection

@section('main_content')

<section id="basic-datatable">
    <div class="row">
        <h1>Stock Transfers</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <div class="d-flex justify-content-between mb-1">
              <h4>All stock transfers</h4>
              <a href="{{ route('transfers.create') }}" class="btn btn-primary">Add</a>
          </div>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th>Date</th>
                    <th>Reference</th>
                    <th>Location From</th>
                    <th>Location To</th>
                    <th scope="col">Note</th>
                    <th scope="col">Total</th>
                    <th>Status</th>
                    <th scope="col">Actions</th>
                  </tr>
              </thead>
              @php
                  $sl=1;
              @endphp
              <tbody id="tableBody" class="text-center">
                  @foreach ($stockTransfers as $stockTransfer)
                  <tr>
                     <td>{{ $sl++ }}</td>
                     <td>{{ $stockTransfer->date }}</td>
                     <td>{{ $stockTransfer->reference }}</td>
                     <td>{{ $stockTransfer->LocationFrom->name }}</td>
                     <td>{{ $stockTransfer->LocationTo->name }}</td>
                     <td>{{ $stockTransfer->note }}</td>
                     <td>{{ $stockTransfer->total_amount }}</td>
                     <td><span class="badge bg-primary">{{ App\Models\StockTransfer::STATUS[$stockTransfer->status] }}</span></td>
                     <td class="buttons">
                        <button class="btn btn-sm btn-success viewBtn" value="{{ $stockTransfer->id }}"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-danger deleteBtn" value="{{ $stockTransfer->id }}"><i class="fas fa-trash"></i></button>
                        @if(Auth::user()->busineess_id == $stockTransfer->LocationTo->id && $stockTransfer->status == 0)
                          <button class="btn btn-sm btn-warning acceptBtn" value="{{ $stockTransfer->id }}">Accept</button>
                        @endif
                        @if(Auth::user()->busineess_id == $stockTransfer->LocationFrom->id && $stockTransfer->status == 1)
                          <button class="btn btn-sm btn-secondary completeBtn" value="{{ $stockTransfer->id }}">Complete</button>
                        @endif
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
                        <b><h4>Date: <span class="date"></span></h4> </b>
                        <b><h4>Reference. : <span class="reference"></span></h4></b>
                        <b><h4>Total: <span class="total"></span> </h4></b>
                        <b><h4>Note: <span class="note"></span> </h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 invoice-col">
                        <b><h4>Outlet From : <span class="from_name"></span></h4></b>
                        <b><h4>Address : <span class="from_address"></span></h4></b>
                        <b><h4>Mobile Number : <span class="from_number"></span></h4></b>
                        <b><h4>Email : <span class="from_email"></span></h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 invoice-col">
                        <b><h4>Outlet To : <span class="to_name"></span></h4></b>
                        <b><h4>Address : <span class="to_address"></span></h4></b>
                        <b><h4>Mobile Number : <span class="to_number"></span></h4></b>
                        <b><h4>Email : <span class="to_email"></span></h4></b>
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
        var stock_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/stock/transfers/" + stock_id,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#myModal').modal('show');
                $('.reference').text(response.stock.reference);
                $('.date').text(response.stock.date);
                $('.note').text(response.stock.note);
                $('.total').text(response.stock.total_amount);

                $('.from_name').text(response.stock.location_from.name);
                $('.from_address').text(response.stock.location_from.city);
                $('.from_number').text(response.stock.location_from.mobile);
                $('.from_email').text(response.stock.location_from.email);

                $('.to_name').text(response.stock.location_to.name);
                $('.to_address').text(response.stock.location_to.city);
                $('.to_number').text(response.stock.location_to.mobile);
                $('.to_email').text(response.stock.location_to.email);

                // products
                var s = "";
                $(response.products).each(function( index,value ) {
                s += `<tr>
                        <td>
                            <span class="name"></span>${value.product.name}<span></span>
                        </td>
                        <td>
                            <span class="qty"></span><span>${value.qty}</span>
                        </td>
                        <td>
                            <span class="price"></span><span>${value.product.selling_price}Tk</span>
                        </td>
                        <td>
                            <span class="subtotal"></span><span>${value.qty * value.product.selling_price}Tk</span>
                        </td>
                    </tr>`
                });

                $('.pbody').append(s);
            }
        });
    });

    //deleting data
    $(document).on('click', '.deleteBtn', function() {
        var stock_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/stock/transfers/" + stock_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.error(response.message);
                location.reload();
            }
        });
    });

    $(document).on('click', '.acceptBtn', function() {
        var stock_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: "/stock/transfers/accept/" + stock_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                location.reload();
            }
        });
    });

    $(document).on('click', '.completeBtn', function() {
        var stock_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: "/stock/transfers/complete/" + stock_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                location.reload();
            }
        });
    });

</script>

@endsection

