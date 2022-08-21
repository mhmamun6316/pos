@extends('layouts.admin_master')

@section('main_content')


<section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <div class="d-flex justify-content-between mb-1">
              <h4>All your products</h4>
          </div>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">Sku</th>
                    <th scope="col">Product</th>
                    <th scope="col">Location</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Current Stock</th>
                    <th scope="col">Current Stock Value <br> <small>(By sale price)</small></th>
                    @if (Auth::user()->role_id == 1)
                        <th scope="col">Current Stock Value <br> <small>(By purchase price)</small></th>
                        <th scope="col">Potential profit</th>
                    @endif
                    {{-- <th scope="col">Total Unit Sold</th>
                    <th scope="col">Total Unit Transferred</th>
                    <th scope="col">Total Unit Adjust</th> --}}
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
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ optional($product->outlet)->name }}</td>
                        <td>{{ $product->selling_price }}TK</td>
                        <td>{{ $product->quantity }}PC</td>
                        <td>{{ $sell }}TK</td>

                        @if ($role == 'Super-admin')
                            <td>{{ $purchase}}TK</td>
                            <td>{{ $sell - $purchase }}TK</td>
                        @endif
                        {{-- <td>0PC</td>
                        <td>0PC</td>
                        <td>0PC</td> --}}
                    </tr>
                  @endforeach
              </tbody>
              <tfoot class="text-center">
                    <tr>
                       @if ($role == 'Super-admin')
                            <td colspan="4"><b>Total:</b></td>
                       @else
                            <td colspan="2"><b>Total:</b></td>
                       @endif
                       <td><b>{{ $total_quantity }}PC</b></td>
                       <td><b>{{ $total_by_purchase }}TK</b></td>
                       <td><b>{{ $total_by_sell }}TK</b></td>
                       <td><b>{{ $total_by_sell - $total_by_purchase }}TK</b></td>
                       {{-- <td><b>0PC</b></td>
                       <td><b>0PC</b></td>
                       <td><b>0PC</b></td> --}}
                    </tr>
              </tfoot>
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
        scrollY: '200px',
        "pageLength": 10
    });
})

</script>
@endsection

