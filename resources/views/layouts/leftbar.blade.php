<style>
    .reports a{
        margin-left: 1rem;
    }
</style>
@php
  $prefix = Request::route();
  $route = Route::current()->getName();
//   dd($prefix->uri);
@endphp

<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="{{ ($prefix->uri=='dashboard') ? 'active' :'' }} nav-item"><a class="d-flex   align-items-center" href="{{ route('dashboard') }}"><i class="fa fas fa-tachometer-alt"></i><span      class="menu-title text-truncate" data-i18n="Calendar">Dashboard</span></a>
      </li>
      @if (Auth::user()->id == 1)
        <li class="{{ ($prefix->uri=='users') ? 'active' :'' }} nav-item"><a class="d-flex align-items-center" href="{{ route('users.index') }}"><i class="fa fas fa-users"></i><span class="menu-title text-truncate" data-i18n="Calendar">Users</span></a>
        </li>
        <li class="{{ ($prefix->uri=='outlets') ? 'active' :'' }} nav-item"><a class=" d-flex align-items-center" href="{{ route('outlets.index') }}"><i class="fa fas fa-database"></i><span class="menu-title text-truncate" data-i18n="Kanban">Outlets</span></a>
        </li>
      @endif

      <li class="{{ ($prefix->uri=='brands') || ($prefix->uri=='categories') || ($prefix->uri =='sub/categories') || ($prefix->uri =='products/create') || ($prefix->uri=='products') || ($prefix->uri =='products/stock') ? 'open' :'' }} nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fas fa-cubes"></i><span class="menu-title text-truncate" data-i18n="Invoice">Products</span></a>

        <ul class="menu-content">
          <li><a class="{{ ($prefix->uri=='brands') ? 'active' :'' }} d-flex align-items-center" href="{{ route('brands.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Brands</span></a>
          </li>
          <li><a class="{{ ($prefix->uri=='categories') ? 'active' :'' }} d-flex align-items-center" href="{{ route('categories.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Categories</span></a>
          </li>
          <li><a class="{{ ($prefix->uri=='sub/categories') ? 'active' :'' }} d-flex align-items-center" href="{{ route('sub.categories.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Sub Categories</span></a>
          </li>
          @if (Auth::user()->id == 1)
            <li><a class="{{ ($prefix->uri=='products/create') ? 'active' :'' }} d-flex align-items-center" href="{{ route('products.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Product</span></a>
            </li>
          @endif
          <li><a class="{{ ($prefix->uri=='products') ? 'active' :'' }} d-flex align-items-center" href="{{ route('products.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List Products</span></a>
          </li>

          <li><a class="{{ ($prefix->uri=='products/stock') ? 'active' :'' }} d-flex align-items-center" href="{{ route('product.stock') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Stock Products</span></a>
          </li>
        </ul>
      </li>

      <li class="{{ ($prefix->uri=='stock/transfers/create') || ($prefix->uri=='stock/transfers') ? 'open' :'' }} nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fas fa-truck"></i><span class="menu-title text-truncate" data-i18n="Invoice">Stock Transfers</span></a>
        <ul class="menu-content">
          <li><a class="{{ ($prefix->uri=='stock/transfers') ? 'active' :'' }} d-flex align-items-center" href="{{ route('transfers.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List Stock Transfers</span></a>
          </li>
          <li><a class="{{ ($prefix->uri=='stock/transfers/create') ? 'active' :'' }} d-flex align-items-center" href="{{ route('transfers.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Stock Transfers</span></a>
          </li>
        </ul>
      </li>

      <li class="{{ ($prefix->uri=='sales') || ($prefix->uri=='pos/create') || ($prefix->uri=='sales/due') ? 'open' :'' }} nav-item"><a class="d-flex align-items-center" href="#"><i class="fab fa-sellcast"></i><span class="menu-title text-truncate" data-i18n="Invoice">Sales</span></a>
        <ul class="menu-content">
          <li><a class="{{ ($prefix->uri=='sales/due') ? 'active' :'' }} d-flex align-items-center" href="{{ route('sales.due') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Due Sales</span></a>
          </li>
          <li><a class="{{ ($prefix->uri=='sales') ? 'active' :'' }} d-flex align-items-center" href="{{ route('sales.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List Sales</span></a>
          </li>
          <li><a class="{{ ($prefix->uri=='pos/create') ? 'active' :'' }} d-flex align-items-center" href="{{ route('pos.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Sales</span></a>
          </li>
        </ul>
      </li>

      <li class="nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fas fa-minus-circle"></i><span class="menu-title text-truncate" data-i18n="Invoice">Expenses</span></a>
        <ul class="menu-content">
          <li><a class="d-flex align-items-center" href="{{ route('expenses.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List Expenses</span></a>
          </li>
          <li><a class="d-flex align-items-center" href="{{ route('expenses.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Expense</span></a>
          </li>
          <li><a class="d-flex align-items-center" href="{{ route('category.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Expense Category</span></a>
          </li>
        </ul>
      </li>

      <li class="{{ ($prefix->uri=='customers') ? 'active' :'' }} nav-item"><a class="d-flex    align-items-center" href="{{ route('customers') }}"><i class="fas fa-user-circle"></i><span      class="menu-title text-truncate" data-i18n="Calendar">Customers</span></a>
      </li>

      <li class="nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fas fa-chart-bar"></i><span class="menu-title text-truncate" data-i18n="Invoice">Reports</span></a>
        <ul class="menu-content reports">
            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('today.report') }}"><i class="fas fa-arrow-circle-right"></i><span class="menu-title text-truncate" data-i18n="Calendar">Today</span></a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('monthly.report') }}"><i class="fas fa-arrow-circle-right"></i><span class="menu-title text-truncate" data-i18n="Calendar">Current Month</span></a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('yearly.report') }}"><i class="fas fa-arrow-circle-right"></i><span class="menu-title text-truncate" data-i18n="Calendar">Yearly</span></a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('customer.due.report') }}"><i class="fas fa-arrow-circle-right"></i><span class="menu-title text-truncate" data-i18n="Calendar">Customer Due</span></a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('top.product.report') }}"><i class="fas fa-arrow-circle-right"></i><span class="menu-title text-truncate" data-i18n="Calendar">Top Products</span></a>
            </li>
        </ul>
      </li>

    </ul>
  </div>
