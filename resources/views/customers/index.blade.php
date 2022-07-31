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
        <h1>All Customers</small>
        </h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card p-2 card-top">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead class="text-center">
                <tr>
                    <th scope="col">SL</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                  </tr>
              </thead>
              @php
                  $sl=1;
              @endphp
              <tbody id="tableBody" class="text-center">
                  @foreach ($customers as $customer)
                  <tr>
                     <td>{{ $sl++ }}</td>
                     <td>{{ $customer->name }}</td>
                     <td>{{ $customer->mobile_number }}</td>
                     <td>{{ $customer->email }}</td>
                     <td>{{ $customer->address }}</td>
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
</script>

@endsection

