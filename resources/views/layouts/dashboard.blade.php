<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}" />

    @livewireStyles
</head>

<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <h1 class="bold text-primary"><strong>ERP 23</strong></h1>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <!-- <li class="sidebar-item">
                <a
                  class="sidebar-link"
                  href="/dashboard"
                  aria-expanded="false"
                >
                  <span>
                    <i class="ti ti-layout-dashboard"></i>
                  </span>
                  <span class="hide-menu">Dasbor</span>
                </a>
              </li> -->

                        <li class="sidebar-item {{ Request::is('produk*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('produk') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-paper-bag"></i>
                                </span>
                                <span class="hide-menu">Produk</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('bahan-baku*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('bahan-baku') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-box"></i>
                                </span>
                                <span class="hide-menu">Bahan Baku</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('bom*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('bom') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-note"></i>
                                </span>
                                <span class="hide-menu">BOM - Bils Of Material</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Manufacturing</span>
                        </li>

                        <li class="sidebar-item {{ Request::is('manufacturing*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('manufacturing') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-clipboard"></i>
                                </span>
                                <span class="hide-menu">Manufacturing Order</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Purchase</span>
                        </li>

                        <li class="sidebar-item {{ Request::is('vendor*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('vendor') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Vendor</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('request-for-quotation*') ? 'selected' : '' }}">
                            <a class="sidebar-link" href="{{ url('request-for-quotation') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-invoice"></i>
                                </span>
                                <span class="hide-menu">Request for Quotation</span>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="w-100">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="ti ti-search"></i> <!-- Tabler Icon search -->
                            </span>
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="basic-addon1" />
                        </div>
                    </div>


                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35"
                                        height="35" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/js/app.min.js') }}"></script>
    <script src="{{ asset('/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/libs/simplebar/dist/simplebar.js') }}"></script>

    @yield('script')

    @livewireScripts

</body>

</html>
