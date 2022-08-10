<!DOCTYPE html>

<html class="loading light-layout" lang="en" data-layout="light-layout" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Unique Pos</title>
    <link rel="apple-touch-icon" href="{{ asset('') }}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css{{ asset('') }}app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/extensions/ext-component-toastr.min.css">
    <!-- END: Page CSS-->

     <!-- BEGIN: Vendor CSS-->
     <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
     <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
     <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
     <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
     <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
     <!-- END: Vendor CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/style.css">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    @yield('css')

    <style>
        .error{
            color: red;
        }
        .card-top{
            border-top: 2px solid blueviolet;
        }
    </style>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('layouts.header');
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" style="overflow-y: auto">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item me-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
              <h4 class="brand-text p-0" style="font-size: 1.3rem;">POS (Rakhi Electronics)</h4></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>

      @include('layouts.leftbar')

    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('main_content')
        </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
       @include('layouts.footer')
    </footer>

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('') }}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('') }}app-assets/vendors/js/charts/apexcharts.min.js"></script> --}}
    <script src="{{ asset('') }}app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('') }}app-assets/js/core/app-menu.min.js"></script>
    <script src="{{ asset('') }}app-assets/js/core/app.min.js"></script>
    <script src="{{ asset('') }}app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('') }}app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{ asset('') }}app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('') }}app-assets/js/scripts/components/components-popovers.min.js"></script>
    <!-- END: Page JS-->

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
    </script>

    @yield('script')
  </body>
  <!-- END: Body-->
</html>
