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

<h2>Add new product</h2>

<form id="add-product" action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <section id="product-info">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-top">
            <div class="card-body">
                <div class="row">

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4><span class="error">*</span> Product Name :</h4></label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter name">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Product Sku :
                            <i class="fa fa-info-circle text-info hover-q no-print" data-bs-toggle="popover" data-bs-content="Unique product id or Stock Keeping Unit Keep it blank to automatically generate sku." data-bs-placement="bottom" data-bs-trigger="hover"></i>
                        </h4></label>
                        <input type="text" class="form-control" name="product_sku" id="product_sku" placeholder="Enter sku">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="disabledInput"><h4><span class="error">*</span> Barcode Type:</h4></label>
                    <select class="form-select" id="barcode_type" name="barcode_type">
                        <option value="C128" selected="selected">Code 128 (C128)</option>
                        <option value="C39">Code 39 (C39)</option>
                        <option value="EAN13">EAN-13</option>
                        <option value="EAN8">EAN-8</option>
                        <option value="UPCA">UPC-A</option>
                        <option value="UPCE">UPC-E</option>
                    </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4> Brand :</h4></label>
                    <select class="form-select" id="brand_id" name="brand_id">
                        <option selected disabled>Select a brand name</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12 mb-1 mb-md-0">
                    <div class="mb-1">
                        <label class="form-label"><h4> Category :</h4></label>
                        <select class="form-select" id="category" name="category_id">
                        <option selected disabled>Select a category name</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Sub Category :</h4></label>
                        <select class="form-select" id="sub_category" name="subcategory_id">
                        <option selected disabled>Select a sub category name</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4><span class="error">*</span> Business Locations: :
                            <i class="fa fa-info-circle text-info hover-q no-print" data-bs-toggle="popover" data-bs-content="Locations where product will be available." data-bs-placement="bottom" data-bs-trigger="hover"></i>
                        </h4></label>
                        <select class="form-select" id="busineess_location" name="busineess_location">
                        <option selected disabled>Select a sub location name</option>
                        @foreach ($outlets as $outlet)
                            <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Alert Quantity :
                            <i class="fa fa-info-circle text-info hover-q no-print" data-bs-toggle="popover" data-bs-content="Enable or disable stock management for a product.Stock Management should be disable mostly for services. Example: Hair-Cutting, Repairing, etc." data-bs-placement="bottom" data-bs-trigger="hover"></i>
                        </h4></label>
                        <input type="number" class="form-control" name="alart_qty" id="alart_qty" placeholder="Alert Quantity">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4>Product image: :</h4></label>
                    <input type="file" class="form-control" name="product_image" id="product_image" placeholder="Enter image">
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="product-desc">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-top">
            <div class="card-body">
                <div class="row">

                <div class="col-xl-8 col-md-8 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4> Product Description :</h4></label>
                    <textarea type="text" class="form-control dt-full-name" name="description" cols="30" rows="4"></textarea>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Product brochure : </h4></label>
                        <input type="file" class="form-control" name="product_brochure" id="product_brochure" placeholder="Enter brochure">
                    </div>
                </div>

                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="product-quantity">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-top">
            <div class="card-body">
                <div class="row">

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4><span class="error">*</span> Product Quantity :</h4></label>
                    <input type="number" class="form-control dt-full-name" name="quantity">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Custom Field 1 : </h4></label>
                        <input type="text" class="form-control" name="custom_field1" id="custom_field1" placeholder="Enter custom field">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4> Custom Field 2 : </h4></label>
                        <input type="text" class="form-control" name="custom_field2" id="custom_field2" placeholder="Enter custom field">
                    </div>
                </div>

                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="product-tax">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-top">
            <div class="card-body">
                <div class="row">

                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label"><h4><span class="error">*</span> Applicable Tax :</h4></label>
                    <select class="form-select" id="tax" name="tax" onchange="calculateDpp()">
                        <option  value="">Please Select</option>
                        <option value="0" selected="selected">None</option>
                        <option value="10" >VAT@10%</option>
                        <option value="10" >CGST@10%</option>
                        <option value="8" >SGST@8%</option>
                        <option value="18" >GST@18%</option>
                    </select>
                    </div>
                </div>
                {{--
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label"><h4><span class="error">*</span> Selling Price Tax Type : </h4></label>
                        <select class="form-select" name="tax_type" id="tax_type">
                            <option value="Inclusive" >Inclusive</option>
                            <option value="Exclusive" >Exclusive</option>
                        </select>
                    </div>
                </div> --}}

                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="product_price">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Dafult Purchase Price</th>
                    <th>x Margin(%) </th>
                    <th>Default Selling Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-6">
                                <label for=""><h5><span class="error">*</span> Exc. tax:</h5></label>
                                <input type="text" name="single_dpp" id="single_dpp" class="form-control" onkeyup="calculateDpp()">
                            </div>
                            <div class="col-md-6">
                                <label for=""><h5> Inc. tax:</h5></label>
                                <input type="number" readonly name="including_tax_dpp" id="including_tax_dpp" class="form-control">
                            </div>
                        </div>
                    </td>
                    <td>
                        <label for=""></label>
                        <input type="text" name="profit_percent" id="profit_percent" class="form-control">
                    </td>
                    <td>
                        <div class="form-group">
                            <label for=""><h5><span class="error">*</span> Inc. tax:</h5></label>
                            <input type="number" name="including_tax_dsp" id="including_tax_dsp" class="form-control">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Save Product</button>
    </div>
</form>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script>

    // calculating default purchase price basis of tax
    function calculateDpp() {
        applicable_tax = parseInt($('select[name="tax"]').val());
        single_dpp = parseInt($('#single_dpp').val());
        including_tax_dpp = $('#including_tax_dpp');
        margin = $('#profit_percent').val();

        if(margin){
            purchase_price = single_dpp + (single_dpp * applicable_tax / 100);
            including_tax_dpp.val(purchase_price);

            selling_price = purchase_price  + (margin*purchase_price)/100;
            $('#including_tax_dsp').val(selling_price);
        }else{
            purchase_price = single_dpp + (single_dpp * applicable_tax / 100);
            including_tax_dpp.val(purchase_price);
        }
    }

    // calculating selling price from margin
    $('#profit_percent').on('keyup',function(){
        margin = parseInt($(this).val());
        including_tax_dpp = parseInt($('#including_tax_dpp').val());

        selling_price = including_tax_dpp  + (margin*including_tax_dpp)/100;
        $('#including_tax_dsp').val(selling_price);
    })

    // calculating margin from selling price
    $('#including_tax_dsp').on('keyup',function(){
        selling_price = parseInt($(this).val());
        including_tax_dpp  = parseInt($('#including_tax_dpp').val());

        profit = selling_price - including_tax_dpp;
        margin = (profit*100)/including_tax_dpp;
        $('#profit_percent').val(margin);
    })


    jQuery.extend(jQuery.validator.messages, {
        required: "This field is required",
        number: "This field should be a number",
        maxlength: jQuery.validator.format("This field must not be more than {0} characters"),
    });

    $('#add-product').validate({
        rules: {
            'product_name':{
                required: true,
                maxlength: 255
            },
            'quantity':{
                number:true,
                required : true,
            },
            'busineess_location':{
                required: true
            },
            'barcode_type':{
                required: true,
            },
            'single_dpp':{
                number:true,
                required: true,
            },
            'including_tax_dpp':{
                number:true,
                required : true,
            },
            'profit_percent':{
                number:true,
                required : true,
            },
            'including_tax_dsp':{
                number:true,
                required : true,
            }
        }
    });

    </script>
@endsection


