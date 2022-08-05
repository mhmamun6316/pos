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
    <strong>Top Products Report</strong>
</h1>

<div class="row">

    <div class="col-12">
        <div class="card">
             <div class="card-body">
                <table class="example table table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                      <tr>
                          <th>Product Name</th>
                          <th>Code</th>
                          <th>Sold Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="text-center">
                        @foreach ($topProducts as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>

</div>

@endsection
