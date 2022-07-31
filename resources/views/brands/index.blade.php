@extends('layouts.admin_master')


@section('css')
<style>
    #name-error
    {
        color:red ;
    }
</style>
@endsection

@section('main_content')

<section id="basic-datatable">
    <div class="row">
        <h1>Brands    <small>Manage your brands</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <div class="d-flex justify-content-between mb-1">
              <h4>All your brands</h4>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa fa-plus"></i> Add</button>
          </div>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
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
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="addForm">
        @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add Brands</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label class="form-label"><h4><span class="error">*</span> Brand Name :</h4></label>
                    <input type="text" class="form-control dt-full-name" name="name">
                </div>
                <div class="mb-1">
                    <label class="form-label"><h4> Brand Description :</h4></label>
                    <textarea type="text" class="form-control dt-full-name" name="description" cols="30" rows="4"></textarea>
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
    <div class="modal-dialog">
      <div class="modal-content">
          <form id="editForm">
          @csrf
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Edit Brands</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="id" id="brand_id">
                  <div class="mb-1">
                      <label class="form-label"><h4><span class="error">*</span> Brand Name :</h4></label>
                      <input type="text" class="form-control dt-full-name" id="name" name="edit_name">
                  </div>
                  <div class="mb-1">
                      <label class="form-label"><h4> Brand Description :</h4></label>
                      <textarea type="text" class="form-control dt-full-name" name="edit_description" cols="30" rows="4"></textarea>
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
                    description : {
                        maxlength : 255,
                    }
                }
            });
        }

        if($("#editForm").length > 0)
        {
            $('#editForm').validate({
                rules:{
                    edit_name : {
                        required : true,
                        maxlength : 255
                    },
                    edit_description : {
                        maxlength : 255,
                    }
                }
            });
        }

    });

    brand();

    //fetching data
    function brand(){
        $.ajax({
            type: "GET",
            url: "/brands/create",
            dataType: "json",
            success: function(response) {
                $("#example").dataTable().fnDestroy();
                var sl = 1;
                $('tbody').html("");
                $.each(response,function(key,item){
                    // console.log(item);
                    var cc =`<tr>
                                <td>${sl++}</td>
                                <td>${item.name}</td>
                                <td>${item.description ? item.description : " "}</td>
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
            url: "/brands",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                brand();
                $("#LoadingImage").hide();
                $(".btn-close").trigger("click");
                $('#addForm').find('input').val("");
            }
        });
    });

    //editing data
    $(document).on('click', '.editBtn', function() {
        var brand_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/brands/" + brand_id +  "/edit/",
            contentType: false,
            processData: false,
            success: function(response) {
                $('#brand_id').val(response.id);
                $('#name').val(response.name);
                $('#description').val(response.description);
            }
        });
    });

    //updating data
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var brand_id = $('#brand_id').val();
        let formData = new FormData($('#editForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/brands/update/" + brand_id,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                brand();
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
        var brand_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/brands/" + brand_id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.error(response.message);
                brand();
            }
        });
    });

</script>
@endsection
