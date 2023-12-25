<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>

    {{-- CSS DataTables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">

    {{-- Chart JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- custom CSS --}}
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Start Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars fa-lg mt-2"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="btn-group" role="group">
                        <a id="btnGroupDrop1" style="color: black; margin-right: 40px;" type="button"
                            class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="nav-icon fas fa-user-circle"></i> &nbsp; {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('profil') }}"><i class="nav-icon fas fa-user"></i>
                                &nbsp; My Profile</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                    class="nav-icon fas fa-sign-out-alt"></i> &nbsp;
                                Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- Notifications Dropdown Menu -->
        </nav>
        <!-- /.navbar -->

        {{-- Sidebar Section --}}
        <aside class="main-sidebar sidebar-dark-primary" id="sidebar">
            <!-- Brand Logo -->
            <img src="https://i.ibb.co/JRM4gy3/logou3.png" alt="img" class="d-flex mx-auto m-0"
                style="width: 240px; height: 200px;">

            <!-- Sidebar -->
            <div class="sidebar
                mt-3">
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Menu sidebar --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- Dashboard --}}
                        <li class="nav-item">
                            <a href="/guru" class="nav-link text-light" style="margin-left: -4px;">
                                <i data-lucide="layout-dashboard"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>


                        {{-- Konten --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-light" style="margin-left: -4px;">
                                <i data-lucide="graduation-cap"></i>
                                <p>Akademi <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('siswa') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="database"></i>
                                        <p>Data Siswa</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('jadwal') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="clipboard-check"></i>
                                        <p>Jadwal Mengajar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('presensi') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="calendar-range"></i>
                                        <p>Presensi Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-light" style="margin-left: -4px;">
                                <i data-lucide="book-check"></i>
                                <p>Pembelajaran <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tugas') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="book-type"></i>
                                        <p>Tugas Siswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengumpulan') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="book-user"></i>
                                        <p>Pengumpulan Tugas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('nilai') }}" class="nav-link ml-3 text-light">
                                        <i data-lucide="book-user"></i>
                                        <p>Nilai Siswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Logout --}}
                        <li class="nav-item mt-5">
                            <a href="{{ url('/logout') }}" class="nav-link" style="margin-left: -2px;">
                                <i data-lucide="log-out"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                {{-- End Menu Sidebar --}}
            </div>
            <!-- /.sidebar -->
        </aside>


        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- Lucide Icon -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    {{-- JS Datatables --}}
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('status'))
            // alert('{{ session('status') }}')
            Swal.fire({
                title: "{{ session('status') }}",
                // text: "You clicked the button!",
                icon: "success",
                button: "OK!",
            });
        @endif

        lucide.createIcons();
    </script>

    @yield('addJS')
</body>

</html>
