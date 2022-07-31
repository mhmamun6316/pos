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

<h2>Add new expense</h2>

<form id="add-expense" action="{{ route('expenses.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <section id="product-info">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-top">
            <div class="card-body">
                <div class="row">

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label"><h4><span class="error">*</span> Outlet :</h4></label>
                        <select class="form-select" id="outlet_id" name="outlet_id">
                            <option selected disabled>Select a outlet name</option>
                            @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label"><h4><span class="error">*</span> Expense Category :</h4></label>
                        <select class="form-select" id="expense_category_id" name="expense_category_id">
                            <option selected disabled>Select a expense category name</option>
                            @foreach ($expenseCategory as $expenseCategori)
                                <option value="{{ $expenseCategori->id }}">{{ $expenseCategori->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label"><h4>Expense Name :</h4></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label"><h4><span class="error">*</span> Expense Amount :</h4></label>
                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount">
                        </div>
                    </div>

                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label"><h4>Remarks :</h4></label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter remarks">
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Save Expense</button>
    </div>
</form>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script>

jQuery.extend(jQuery.validator.messages, {
    required: "This field is required",
    number: "This field should be a number",
    maxlength: jQuery.validator.format("This field must not be more than {0} characters"),
});

$('#add-expense').validate({
    rules: {
        'outlet_id':{
            required: true,
        },
        'expense_category_id':{
            required : true,
        },
        'amount':{
            required: true,
            number:true
        }
    }
});

</script>
@endsection


