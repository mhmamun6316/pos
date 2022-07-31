@extends('layouts.admin_master')

@section('css')
    <style>
        .bg-primary th{
            color: white!important;
        }
    </style>
@endsection

@section('main_content')

<div class="mb-2">
    <div class="row mb-2">
        @if(Auth::user()->role_id == 1)
            <div class="col-md-3">
                <select name="outlet_type" id="outlet_type" class="form-select">
                    <option selected value="0">All Outlets</option>
                    @foreach ($outlets as $outlet)
                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-md-3">
            <select name="brand_type" id="brand_type" class="form-select">
                <option selected value="0">All Brands</option>
                @foreach ($brands as $brand)
                   <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="category_type" id="category_type" class="form-select">
                <option selected value="0">All Categories</option>
                @foreach ($categories as $category)
                   <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="sub_category_type" id="sub_category_type" class="form-select">
                <option selected value="0">All Sub Categories</option>
                @foreach ($subcategories as $subcategory)
                   <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="">From Date</label>
            <input type="date" id="from_date" name="from_date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="">To Date</label>
            <input type="date" id="to_date" name="to_date" class="form-control">
        </div>
    </div>
</div>

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
                    <th scope="col">SL</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Outlet</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    {{-- <th scope="col">Sub Category</th> --}}
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody id="tableBody" class="text-center">

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
                  <h4 class="modal-title" id="myModalLabel1"><span class="name"></span></h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-3 invoice-col">
                        <b><h4> SKU : <span class="sku"></span></h4></b>
                        <b><h4>Brand : <span class="brand"></span></h4> </b>
                        <b><h4>Barcode Type : <span class="barcode"></span> </h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3 invoice-col">
                        <b><h4>Available in Outlet : <span class="outlet"></span></h4></b>
                        <b><h4>Category : <span class="category"></span></h4></b>
                        <b><h4>Sub category : <span class="subcategory"></span></h4></b>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3 invoice-col">
                        <b><h4>Quantity : <span class="quantity"></span></h4></b>
                        <b><h4>Alert quantity : <span class="alert_qty"></span></h4></b>
                        <b><h4>Applicable Tax : <span class="tax"></span></h4> </b>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 invoice-img">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Product Details:</b></p>
                        <div class="table-responsive mb-3">
                            <table class="table bg-gray">
                                <tbody class="pbody">
                                    <tr class="bg-primary">
                                        <th>Default Purchase Price (Exc. tax)</th>
                                        <th>Default Purchase Price (Inc. tax)</th>
                                        <th>x Margin(%)</th>
                                        <th>x Margin(Tk)</th>
                                        <th>Default Selling Price (Inc. tax)</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="exc_dpp"></span><span>Tk</span>
                                        </td>
                                        <td>
                                            <span class="inc_dpp"></span><span>Tk</span>
                                        </td>
                                        <td>
                                            <span class="parcent_margin"></span><span>%</span>
                                        </td>
                                        <td>
                                            <span class="taka_margin"></span><span>Tk</span>
                                        </td>
                                        <td>
                                            <span class="inc_dsp"></span><span>Tk</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p><b>Product Stock Details:</b></p>
                        <div class="table-responsive mb-2">
                            <table class="table bg-gray">
                                <tbody class="pbody">
                                    <tr class="bg-primary">
                                        <th>SKU</th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Current stock</th>
                                        <th>Current Stock Value</th>
                                        <th>Total unit sold</th>
                                        <th>Total Unit Transfered</th>
                                        <th>Total Unit Adjusted</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="pro_sku"></span>
                                        </td>
                                        <td>
                                            <span class="pro_name"></span>
                                        </td>
                                        <td>
                                            <span class="pro_price"></span><span>Tk</span>
                                        </td>
                                        <td>
                                            <span class="pro_stock"></span><span>Pc</span>
                                        </td>
                                        <td>
                                            <span class="pro_value"></span><span>Tk</span>
                                        </td>
                                        <td>
                                            <span class="pro_sold">0Pc</span>
                                        </td>
                                        <td>
                                            <span class="pro_transfer">0Pc</span>
                                        </td>
                                        <td>
                                            <span class="pro_adjust">0Pc</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
    </div>
</div>

@endsection

@section('script')
<script>

    // get all product
    product();

    //fetching data
    function product(outlet=0,brand=0,category=0,subcategory=0,start_date=0,to_date=0){
        $.ajax({
            type: "GET",
            url: `/products/get/all/${outlet}/${brand}/${category}/${subcategory}/${start_date}/${to_date}`,
            dataType: "json",
            success: function(response) {
                $("#example").dataTable().fnDestroy();
                var sl = 1;
                $('#tableBody').html("");
                var role = response.role;
                $.each(response.products,function(key,item){
                    var photo = `{{asset('uploads/product.png')}}`;
                    if(item.image!=null)
                    {
                        photo = `{{asset('${item.image}')}}`;
                    }
                    var cc =`<tr>
                                <td>${sl++}</td>
                                <td><img src=" ` + photo  +  `" class="uploadedAvatar rounded me-50" alt="product image" height="80" width="80"></td>
                                <td>${item.name}</td>
                                <td>${item.outlet_name ? item.outlet_name : " "}</td>
                                <td>${item.brand_name ? item.brand_name : " "}</td>
                                <td>${item.categories_name ? item.categories_name : " "}</td>
                                <td>${role == 'Super-admin' ? item.inc_purchase_price  : " "}</td>
                                <td>${item.selling_price}</td>
                                <td>
                                    <button class="btn btn-sm btn-success viewBtn" value="${item.id}"><i class="fas fa-eye"></i></button>
                                    <a href="{{ url('products/${item.id}/edit') }}" class="btn btn-sm btn-warning" value="${item.id}"><i class="fa fa-pencil-alt"></i></a>
                                    <button class="btn btn-sm btn-danger deleteBtn" value="${item.id}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>`
                    $('#tableBody').append(cc);
                });
                $('#example').DataTable({
                    scrollX: true,
                    scrollY: '300px',
                    // stateSave: true,
                    "pageLength": 10
                });
            }
        });
    }

    var outlet = 0;
    var brand = 0;
    var category = 0;
    var subcategory = 0;
    var start_date = 0;
    var to_date = 0;

    $('#outlet_type').on('change',function(e)
    {
        outlet = $(this).find(":selected").val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    $('#brand_type').on('change',function(e){
        brand =$(this).find(":selected").val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    $('#category_type').on('change',function(e){
        category =$(this).find(":selected").val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    $('#sub_category_type').on('change',function(e){
        subcategory =$(this).find(":selected").val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    $('#from_date').on('change',function(e){
        start_date =$(this).val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    $('#to_date').on('change',function(e){
        to_date =$(this).val();
        product(outlet,brand,category,subcategory,start_date,to_date);
    });

    // view product
    $(document).on('click', '.viewBtn', function() {
        $('.invoice-img').empty();
        $('.inc_dsp').empty();
        $('.inc_dpp').empty();
        $('.exc_dpp').empty();
        $('.parcent_margin').empty();
        $('.taka_margin').empty();
        $('.pro_sku').empty();
        $('.pro_value').empty();
        $('.pro_price').empty();
        $('.pro_stock').empty();
        $('.pro_name').empty();
        var product_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/products/" + product_id,
            contentType: false,
            processData: false,
            success: function(response) {
                var photo = `{{asset('uploads/product.png')}}`;
                var subcategory = "none";
                var brand = "none";
                var category = "none";
                if(response.image!=null)
                {
                    photo = `{{asset('${response.image}')}}`;
                }
                if(response.subcategory != null){
                    subcategory = response.subcategory.name;
                }
                if(response.brand != null){
                    brand = response.brand.name;
                }
                if(response.category != null){
                    category = response.category.name;
                }
                var a =" ";
                $('#myModal').modal('show');
                console.log(response);
                $('.name').text(response.name);
                $('.sku').text(response.sku);
                $('.brand').text(brand);
                $('.outlet').text(response.outlet.name);
                $('.category').text(category);
                $('.subcategory').text(subcategory);
                $('.alert_qty').text(response.alert_quantity);
                $('.tax').text(response.applicable_tax);
                a = `<img src=" ` + photo  +  `" class="image" alt="Product image" width="90%" height="70%">`;
                $('.invoice-img').append(a);

                // product details
                $('.inc_dsp').prepend(response.selling_price);
                $('.inc_dpp').prepend(response.inc_purchase_price);
                $('.exc_dpp').prepend(response.exc_purchase_price);
                $('.parcent_margin').prepend(response.margin);
                $('.taka_margin').prepend(response.selling_price - response.inc_purchase_price);

                // product stock details
                $('.pro_sku').prepend(response.sku);
                $('.pro_name').prepend(response.name);
                $('.pro_price').prepend(response.selling_price);
                $('.pro_stock').prepend(response.quantity);
                $('.pro_value').prepend(response.selling_price * response.quantity);

            }
        });
    });

    // delete product
    $(document).on('click','.deleteBtn',function(){
        var product_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/products/" + product_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.error(response.message);
                product();
            }
        });
    });

</script>
@endsection

