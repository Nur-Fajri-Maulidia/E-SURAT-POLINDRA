<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/polindra.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <style>
        /* CSS */
        @media (max-width: 991px) {
            .offcanvas-collapse {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -250px;
                /* Mulai dari luar layar sebelah kiri */
                width: 250px;
                /* Sesuaikan lebar sesuai kebutuhan */
                transition: left 0.3s ease-in-out;
                /* Animasi transisi */
                background: #fff;
                /* Warna latar belakang */
                z-index: 1050;
                /* Pastikan berada di atas konten lain */
            }

            .offcanvas-collapse.open {
                left: 0;
                /* Geser masuk layar saat dibuka */
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.5);
                /* Warna overlay */
                z-index: 1040;
                /* Di bawah Offcanvas */
                display: none;
                /* Mulai tersembunyi */
            }

            .offcanvas-collapse.open~.overlay {
                display: block;
                /* Tampilkan overlay saat Offcanvas terbuka */
            }
        }
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    @stack('styles')
</head>

<body>
    <x-admin.Navbar />
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="sidebar-wrapper">
                <x-admin.Sidebar />
            </div>
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <x-admin.Footer />
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').on('click', function() {
                $('.offcanvas-collapse').toggleClass('open');
            });
        });
    </script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    @stack('scripts')
</body>

</html>
