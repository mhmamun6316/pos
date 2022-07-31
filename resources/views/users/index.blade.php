@extends('layouts.admin_master')


@section('css')
<style>
    .error
    {
        color:red!important ;
    }
    .modal-body .row{
        margin-bottom: 10px;
    }
</style>
@endsection

@section('main_content')

<section id="basic-datatable">
    <div class="row">
        <h1>Users    <small>Manage all users</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <div class="d-flex justify-content-between mb-1">
              <h4>All Users</h4>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa fa-plus"></i> Add</button>
          </div>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Actions</th>
                  </tr>
              </thead>
              <tbody id="tableBody" class="text-center">

              </tbody>
          </table>
        </div>
      </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade text-start" id="add" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="addForm" enctype="multipart/form-data">
        @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add Users</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> User Name :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> User Role :</h4></label>
                        <select class="form-select" name="role_id">
                            <option value="2" selected >Cashier</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Password :</h4></label>
                        <input type="password" class="form-control dt-full-name" name="password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Confirm Password :</h4></label>
                        <input type="password" class="form-control dt-full-name" name="password_confirmation">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Outlet Name :</h4></label>
                        <select class="form-select" name="outlet_id">
                            @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Email :</h4></label>
                        <input type="email" class="form-control dt-full-name" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4>Phone :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="phone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4> Photo :</h4></label>
                        <input type="file" class="form-control dt-full-name" name="photo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4> Gender :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="gender">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4> Date Of Birth :</h4></label>
                        <input type="date" class="form-control dt-full-name" name="dob">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4> Address :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="address">
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

<!--Edit Modal -->
<div class="modal fade text-start" id="edit" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form id="editForm">
          @csrf
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Edit User</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> User Name :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="name" id="name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> User Role :</h4></label>
                        <select class="form-select" name="role_id" id="role_id">
                            <option value="2">Cashier</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Password :</h4></label>
                        <input type="password" class="form-control dt-full-name" name="password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Confirm Password :</h4></label>
                        <input type="password" class="form-control dt-full-name" name="password_confirmation">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Outlet Name :</h4></label>
                        <select class="form-select" name="outlet_id" id="outlet_id">
                            @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4><span class="error">*</span> Email :</h4></label>
                        <input type="email" class="form-control dt-full-name" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4>Phone :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="phone" id="phone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4> Photo :</h4></label>
                        <input type="file" class="form-control dt-full-name" name="photo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4> Gender :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="gender" id="gender">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><h4> Date Of Birth :</h4></label>
                        <input type="date" class="form-control dt-full-name" name="dob" id="dob">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label"><h4> Address :</h4></label>
                        <input type="text" class="form-control dt-full-name" name="address"  id="address">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>


    //form validations
    $(document).ready(function(){
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
                    name : {
                        required : true,
                        maxlength : 255
                    },
                    phone : {
                        required : true,
                        maxlength: 11,
                        minlength: 11
                    },
                    email : {
                        email: true,
                        required : true,
                    },
                    password:{
                        required : true,
                        minlength : 6,
                    },
                    password_confirmation:{
                        required : true,
                        minlength : 6,
                    },
                    outlet_id:{
                        required : true,
                    }
                }
            });
        }

        if($("#editForm").length > 0)
        {
            $('#editForm').validate({
                rules:{
                    name : {
                        required : true,
                        maxlength : 255
                    },
                    phone : {
                        required : true,
                        maxlength: 11,
                        minlength: 11
                    },
                    email : {
                        email: true,
                        required : true,
                    },
                    password:{
                        required : true,
                        minlength : 6,
                    },
                    password_confirmation:{
                        required : true,
                        minlength : 6,
                        equalTo: '#password'
                    },
                    outlet_id:{
                        required : true,
                    }
                }
            });
        }
    });

    user();

    //fetching data
    function user(){
        $.ajax({
            type: "GET",
            url: "/users/create",
            dataType: "json",
            success: function(response) {
                $("#example").dataTable().fnDestroy();
                var sl = 1;
                $('tbody').html("");
                $.each(response,function(key,item){
                    console.log(item);
                    var cc =`<tr>
                                <td>${sl++}</td>
                                <td>${item.name}</td>
                                <td>${item.email ? item.email : " "}</td>
                                <td>${item.phone ? item.phone : " "}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#edit" value="${item.id}"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-sm btn-danger deleteBtn" value="${item.id}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>`
                    $('tbody').append(cc);
                });
                $('#example').DataTable({
                    scrollX: true,
                    "pageLength": 10
                });
            }
        });
    }

    //adding data
    $('#addForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData($('#addForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/users",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    user();
                    $(".btn-close").trigger("click");
                    $('#addForm').find('input').val("");
                }
            });
    });

    //editing data
    $(document).on('click', '.editBtn', function() {
        var user_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/users/" + user_id +  "/edit",
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#user_id').val(response.id);
                $('#name').val(response.name);
                $('#outlet_id').val(response.busineess_id);
                $('#email').val(response.email);
                $('#phone').val(response.phone);
                $('#address').val(response.address);
                $('#dob').val(response.dob);
                $('#gender').val(response.gender);
                $('#custom2').val(response.custom2);
            }
        });
    });

    //updating data
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var user_id = $('#user_id').val();
        let formData = new FormData($('#editForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/users/update/" + user_id,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                user();
                $(".btn-close").trigger("click");
                $('#editForm').find('input').val("");
            },
            error: function (request, status, error) {
                // your error actions
            }
        });
    });

    //deleting data
    $(document).on('click', '.deleteBtn', function() {
        var outlet_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/users/" + outlet_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.error(response.message);
                user();
            }
        });
    });

</script>
@endsection
