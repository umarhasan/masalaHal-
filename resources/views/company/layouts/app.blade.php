<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Dashboard  | Bark Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{asset('/admin/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{asset('/admin/plugins/toastr/toastr.min.css')}}">

    {{-- Datatable Responsive --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"  />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css" />

    <!-- Page CSS -->
    <script src="{{asset('/admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{asset('/admin/assets/js/config.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/company/dashboard" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/images/logo.png') }}" class="logo1" style="width:50%;"/>
                        </span>
                        <span class="demo menu-text fw-bolder ms-2" style="font-size:30px">Quick Solutions</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="/company/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-tachometer"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->routeIs('company.lead_genrate')? 'active' : '' }}">
                        <a href="{{route('company.lead_genrate')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-tachometer"></i>
                            <div data-i18n="Analytics">Leads</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('company.purchase_lead')? 'active' : '' }}">
                        <a href="{{route('company.purchase_lead')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-tachometer"></i>
                            <div data-i18n="Analytics">Picked Leads</div>
                        </a>
                    </li>
                    <!-- Account Setting -->
                    <li class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Layouts">Account Setting</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('profile') ? 'active' : '' }}">
                                <a href="{{route('company.profile')}}" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('change_password') ? 'active' : '' }}">
                                <a href="{{route('company.change_password')}}" class="menu-link">
                                    <div data-i18n="Without navbar">Change Password</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="{{ url('/logout') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-log-out"></i>
                            <div data-i18n="Analytics">Logout</div>
                        </a>
                    </li>
                </ul>

            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('company.layouts.nav')
                <!-- / Navbar -->
                 <!-- Content wrapper -->
                <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
                <!-- / Content -->
                <!-- Footer -->
                @include('company.layouts.footer')
                <!-- / Footer -->
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js')}}"></script>
    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js')}}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js')}}"></script>
    {{-- Datatable Responsive --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
    <script>
        new DataTable('#example', {
            responsive: true
        });
    </script>

</body>
</html>
