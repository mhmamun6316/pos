@extends('layouts.admin_master')

@section('css')
<style>
    .select2-container{
        width: 93%!important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b{
        display: none!important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white !important;
    }
</style>

@endsection

@section('main_content')
<h2>Add Stock Transfer</h2>

<form class="addForm" action="{{ route('transfers.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <section id="product-info">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-top">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                <label class="form-label"><h4><span class="error">*</span> Date :</h4></label>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Enter name">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label"><h4> Reference No : </h4></label>
                                    <input type="text" class="form-control" name="reference" id="reference" placeholder="Enter reference">
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label"><h4><span class="error">*</span> Location From :</h4></label>
                                    <select class="form-select" name="location_from" id="location_from">
                                        <option value="" disabled selected>Select a outlet</option>
                                        @foreach ($outlets as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label"><h4><span class="error">*</span> Location To :</h4></label>
                                    <select class="form-select" name="location_to" id="location_to">
                                        <option value="" disabled selected>Select a outlet</option>
                                        @foreach ($outlets as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                <label class="form-label"><h4> Note :</h4></label>
                                <input type="text" class="form-control" name="note" id="note" placeholder="Enter note">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="search-product">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-top">
                    <h3 class="m-1">Search Product</h3>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="input-group mb-1" style="width:80%">
                                <div class="input-group-prepend">
                                <span style="height: 100%" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <select class="js-example-basic-single" name="search"  aria-describedby="basic-addon1">
                                    <option value="" selected disabled>Select a product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="table-responsive" style="width:80%">
                                <table class="table table-bordered table-striped table-condensed" id="stock_adjustment_product_table">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-4 text-center">
                                                Product
                                            </th>
                                            <th class="col-sm-2 text-center">
                                                Quantity
                                            </th>
                                            <th class="col-sm-2 text-center">
                                                Unit Price
                                            </th>
                                            <th class="col-sm-2 text-center">
                                                Subtotal
                                            </th>
                                            <th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">

                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center"><td colspan="3"></td><td class="p-0"><div class="pull-right"><b>Total:</b> <input class="form-control text-center" style="border:none" name="total" readonly value="0.00" id="total_adjustment"></div></td></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <button  type="submit" class="btn btn-success">Save</button>
</form>

@endsection

@section('script')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-single").prop('disabled', true);

        product();

        //fetching data
        async  function product(){
           await  $.ajax({
                type: "GET",
                url: `/stock/transfers/all`,
                dataType: "json",
                success: function(data) {
                    $('.tbody').html("");
                    $('#total_adjustment').val("");
                    var a = "";
                    var subtotal = 0;
                    var total = 0;
                    $.each(data, function(key, value) {
                    subtotal = value.quantity * value.product.selling_price;
                    total = total + subtotal;
                    a += `<tr>
                            <input type="hidden" name="product[${value.product.id}][id]" value="${value.product.id}">
                            <td class="p-0"><input readonly class="form-control product_name" style="border:none" type="text" value="${value.product.name}" name="product[${value.product.id}][name]"></td>
                            <td class="p-0 d-flex align-items-center"><input readonly class="form-control pro_qty" style="border:none" type="text" value="${value.quantity}" name="product[${value.product.id}][qty]">
                                <button type="button" class="add_qty btn btn-primary btn-sm" value="${value.product.id}">+</button>
                            </td>
                            <td class="p-0"><input class="form-control" style="border:none" type="text" readonly value="${value.product.selling_price}" name="product[${value.product.id}][selling_price]"></td>
                            <td class="p-0"><input class="form-control" style="border:none" type="text" readonly value="${subtotal}" name="product[${value.product.id}][subtotal]"></td>
                            <td><button type="button" class="btn btn-sm btn-danger deleteBtn" value="${value.id}"><i class="fa fa-trash" aria-hidden="true"></button></i></td>
                        </tr>`;
                    });
                    $('#total_adjustment').val(total);
                    $('.tbody').append(a);
                    $('#example').DataTable({
                        scrollX: true,
                        "pageLength": 10
                    });
                }
            });
        }

        $('select[name="search"]').on('change', function() {
            // var location_id = $('#location_to').val();
            // alert(location_id);
            var product_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/stock/add/" + product_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    toastr.success(data.message)
                    product()
                },
            });
        });

        $(document).on("click",".deleteBtn",function(){
            product_id = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                url: "/temporary/stock/delete/" + product_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    toastr.error(data.message);
                    product();
                },
            });
        })

        $(document).on("click",".add_qty",function(){
            product_id = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                url: "/temporary/stock/increment/" + product_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    toastr.success(data.message);
                    product();
                },
            });
        })

        $(document).on("change","#location_to",function(){
            $(".js-example-basic-single").prop('disabled', false);
        })

    });

</script>



@endsection


