@extends('layouts.admin_master')

@section('css')
<style>
    .error
    {
        color:red!important ;
    }
    .select2-container{
        width: 93%!important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b{
        display: none!important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white !important;
    }

    .form-group{
        display: flex;
        margin-bottom: 5px;
    }

    .form-group label{
        width: 50%;
        display: flex;
        align-items: center;
    }

    .card{
        margin-bottom: 10px;
    }

    .cart-total td{
        padding:10px 2px;
    }

</style>
@endsection

@section('main_content')

<form id="addForm" action="{{ route('sales.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <section id="add-customer" style="margin-top: -1.5rem">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-top">
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <p class="bg-primary text-white d-inline" style="padding:5px">Customer Details</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="error">*</span>Name </label>
                                    <input type="text" name="customer_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="error">*</span>Mobile Number</label>
                                    <input type="text" name="customer_mobile" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><span class="error">*</span> Address </label>
                                        <input type="text" name="customer_address" class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="customer_email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">National Id</label>
                                        <input type="text" name="customer_national" class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Credit Card Number</label>
                                    <input type="text" name="customer_card" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="add-sale">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-top">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <label for="">Search Product</label>
                                    <select class="js-example-basic-single products" name="products"  aria-describedby="basic-addon1">
                                        <option value="" selected disabled>Select a product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})
                                                ({{ $product->quantity }} pcs)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Model & Code</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>SubTotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="allPos">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="discount">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Mode</label>
                    <select name="payment_mode" id="" class="form-select">
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Card">Card</option>
                        <option value="Installment">Installment</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cheque No</label>
                    <input type="number" name="check_no" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Pay </label>
                    <input type="number" class="form-control" name="paid_amount" value="0">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Installment type</label>
                    <select name="installment_mode" id="" class="form-select">
                        <option value="">select one</option>
                        <option value="Half-Monthly">Half-Monthly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Remarks</label>
                    <input type="text" class="form-control" name="remarks">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{-- <button type="button" class="calculateBtn btn btn-primary" style="margin-right: 5px;">Calculate</button> --}}

        <a target="_blank" ><button type="submit" class="btn btn-success">Sale</button></a>
    </div>
</form>
@endsection

@section('script')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script>
     $(document).ready(function() {
        $(".js-example-basic-single").select2();

        jQuery.extend(jQuery.validator.messages, {
            required: "This field is required",
            number: "This field should be a number",
            email: "This should be and email",
            equalTo: "please write the same password again",
            maxlength: jQuery.validator.format("This field must not be more than {0} characters"),
            minlength: jQuery.validator.format("This field must be minimum {0} characters"),
        });

        if($("#addForm").length > 0)
        {
            $('#addForm').validate({
                rules:{
                    customer_name : {
                        required : true,
                        maxlength : 255
                    },
                    customer_mobile : {
                        required : true,
                        maxlength : 255,
                    },
                    customer_address : {
                        required : true,
                        maxlength : 255,
                    }
                }
            });
        }

     });

     allPos();

     function allPos(){
         $.ajax({
             type: 'GET',
             url: "/pos",
             dataType: 'json',
             success: function(response) {
                 var rows = ""
                 $.each(response.carts, function(key, value) {

                     rows += ` <tr class="text-center">
                                 <td>
                                     ${value.name}
                                 </td>
                                 <td>
                                    <div class="input-group">
                                        <span class="d-flex justify-content-center">
                                            <span class="btn btn-sm btn-primary d-flex align-items-center" id="${value.rowId}" onclick="cartIncrement(this.id)">+</span>
                                            <input class="form-control text-center" readonly type="text"  value="${value.qty}" data-min="1" style="width:50%">
                                            <span class="btn btn-sm btn-danger d-flex align-items-center" id="${value.rowId}" onclick="cartDecrement(this.id)">-</span>
                                        </span>
                                    </div>
                                 </td>
                                 <td>
                                     ৳ ${value.price}
                                 </td>
                                 <td>
                                     ৳ ${value.subtotal}
                                 </td>
                                 <td>
                                     <a title="Remove this item" class="remove" href="#" id="${value.rowId}" onclick="CartRemove(this.id)">
                                         <i class="fa fa-times"></i>
                                     </a>
                                 </td>
                             </tr>`
                 });
                 rows += `
                        <tr class="cart-total text-center">
                            <td>Total: ৳ <span class="min_total">${response.cartTotal}</span></td>

                            <td>Special Disc: <input type="number" name="special_disc" class="special_disc" onkeyup="calculate()" placeholder="0" style="width:50%"></td>

                            <td>Vat(%): <input class="vat" type="number" name="vat" onkeyup="calculate()" placeholder="0" style="width:50%"></td>

                            <td>Discount (%): <input type="number" class="percent_disc" name="percent_disc" onkeyup="calculate()" placeholder="0" style="width:50%"></td>

                            <td>Payable: <input readonly class="grand_total" type="number" name="grand_total" placeholder="0"    style="width:50%" value="${response.cartTotal}">
                            </td>
                        </tr>`
                 $('.allPos').html(rows);
             }
         })
     }

     //Start add to cart product
     $(document).on("change",".products",function(){
         id = $(this).val()
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $.ajax({
             url: "/add/to/pos/" + id,
             type: "POST",
             dataType: "json",
             success: function(data) {
                 toastr.success(data.message);
                 allPos();
             },
         });
     })

     function cartIncrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/pos/increment/" + rowId,
            dataType: 'json',
            success: function(data) {
                toastr.success(data.message);
                allPos();
            }
        });
     }

     function cartDecrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/pos/decrement/" + rowId,
            dataType: 'json',
            success: function(data) {
                toastr.success(data.message)
                allPos();
            }
        });
     }

     function CartRemove(id) {
        $.ajax({
            type: 'GET',
            url: "/pos/remove/" + id,
            dataType: 'json',
            success: function(data) {
                toastr.success(data.message)
                allPos();
            }
        });
     }

     var special_disc = 0;
     var percent_disc = 0;
     var vat = 0;

     function calculate(){
        if($('.special_disc').val()){
            special_disc = Number($('.special_disc').val())
        }
        if($('.vat').val()){
            vat = Number($('.vat').val())
        }
        if($('.percent_disc').val()){
            percent_disc = Number($('.percent_disc').val())
        }

        min_total = Number($('.min_total').text());

        var p_vat = Math.round((min_total * vat) / 100)
        min_total += p_vat;

        min_total -= special_disc;

        var p_discount = Math.round((min_total * percent_disc) / 100);
        min_total -= p_discount;

        $('.grand_total').val(min_total);
     }

</script>
@endsection


