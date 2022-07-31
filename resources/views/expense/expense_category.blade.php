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
        <h1>All Expenses Category</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
            <div class="d-flex justify-content-between mb-1">
                <h4>All your expense category</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa fa-plus"></i> Add</button>
            </div>
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th>Expense Category Name</th>
                    <th>Actions</th>
                  </tr>
              </thead>
              @php
                  $sl=1;
              @endphp
              <tbody id="tableBody" class="text-center">
                  @foreach ($expenseCategories as $expenseCategorie)
                  <tr>
                     <td>{{ $sl++ }}</td>
                     <td>{{ $expenseCategorie->name }}</td>
                     <td>
                         <button class="btn btn-sm btn-danger deleteBtn" value="{{ $expenseCategorie->id }}"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  @endforeach
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
                  <h4 class="modal-title" id="myModalLabel1">Add Expense Category</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-1">
                      <label class="form-label"><h4><span class="error">*</span> Category Name :</h4></label>
                      <input type="text" class="form-control dt-full-name" name="name">
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
    $(document).ready(function(){
        $('#example').DataTable({
            scrollX: true,
            "pageLength": 10
        });
    });

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
                }
            }
        });
    }

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
            url: "/expenses/category",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                location.reload();
            }
        });
    });

    //deleting data
    $(document).on('click', '.deleteBtn', function() {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/expenses/category/" + id ,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.error(response.message);
                location.reload();
            }
        });
    });
</script>


@endsection

