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
    .form-group{
        margin-bottom: 5px;
    }
</style>
@endsection

@section('main_content')

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
                    <th>Due Amount</th>
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
                     <td>{{ $sale->due_amount }}</td>
                     <td>
                        <button class="btn btn-sm btn-primary payBtn" value="{{ $sale->id }}">Pay</button>
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
    <div class="modal-dialog modal-md d-flex justify-content-center">
      <div class="modal-content" style="width: 90%;">
          <form id="addForm">
          @csrf
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <input type="hidden" class="order_id" name="order_id">
              <div class="modal-body">
                  <div class="form-group">
                    <label for=""><span class="error">*</span> Payment Amount </label>
                    <input type="text" name="due_payment" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for=""><span class="error">*</span> Payment Date</label>
                    <input type="date" name="payment_date" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for=""> Remarks</label>
                    <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
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

// view modal
$(document).on('click', '.payBtn', function() {
    $('#myModal').modal('show');
    var order_id = $(this).val();
    $('.order_id').val(order_id);
});

$("#addForm").submit(function() {
    event.preventDefault(); // prevent actual form submit
    var form = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
         type: "POST",
         url: '/sales/due',
         data: form.serialize(), // serializes form input
         success: function(data){
            location.reload();
         }
    });
});

</script>

@endsection


