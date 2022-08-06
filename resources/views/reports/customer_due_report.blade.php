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

<h1 class="header-title">
    <strong>Customer Due Report</strong>
</h1>

<div class="row">

    <div class="col-12">
        <div class="card p-2 card-top">
            <div class="row">
                <div class="col-md-5">
                    <input type="date" class="form-control start_date" name="start_date" >
                </div>
                <div class="col-md-5">
                    <input type="date" class="form-control end_date" name="end_date" >
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary dateFilter" type="button">Filter</a>
                </div>
            </div>
        </div>
    </div>

    <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card p-2 card-top">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                  <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Due Amount</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="text-center">

                </tbody>
            </table>
            </div>
          </div>
        </div>
    </section>
</div>

@endsection

@section('script')
    <script>
            getAllDueCustomer();

            function getAllDueCustomer(start_date=0,end_date=0){
                $.ajax({
                    type: "GET",
                    url: `/customer/due/report/data/${start_date}/${end_date}`,
                    dataType: "json",
                    success: function(response) {
                        $("#example").dataTable().fnDestroy();
                        var sl = 1;
                        $('#tableBody').html("");
                        $.each(response.customers,function(key,item){
                            var cc =`<tr>
                                        <td>${sl++}</td>
                                        <td>${item.name}</td>
                                        <td>${item.email}</td>
                                        <td>${item.mobile_number}</td>
                                        <td>${item.address}</td>
                                        <td>${item.due_amount}</td>
                                    </tr>`
                            $('#tableBody').append(cc);
                        });
                        $('#example').DataTable({
                            scrollX: true,
                            "pageLength": 10
                        });
                    }
                });
            }

            $(document).on('click', '.dateFilter', function() {
                var start_date = $('.start_date').val();
                var end_date = $('.end_date').val();
                getAllDueCustomer(start_date,end_date);
            });
    </script>
@endsection
