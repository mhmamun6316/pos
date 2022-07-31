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
        <h1>All Expenses</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th>Outlet</th>
                    <th>Expense Category</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                  </tr>
              </thead>
              @php
                  $sl=1;
              @endphp
              <tbody id="tableBody" class="text-center">
                  @foreach ($expenses as $expense)
                  <tr>
                     <td>{{ $sl++ }}</td>
                     <td>{{ $expense->outlet->name }}</td>
                     <td>{{ $expense->category->name }}</td>
                     <td>{{ $expense->name }}</td>
                     <td>{{ $expense->amount }}</td>
                     <td>
                        <button class="btn btn-sm btn-danger deleteBtn" value="{{ $expense->id }}"><i class="fas fa-trash"></i></button>
                     </td>
                  </tr>
                  @endforeach
              </tbody>
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
            "pageLength": 10
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
            url: "/expenses/" + id ,
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

