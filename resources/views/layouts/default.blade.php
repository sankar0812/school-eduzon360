<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path=""
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="" href="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />



<!-- //high chart -->
<!-- <script src="https://d3js.org/d3.v5.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('assets/js/config.js') }}"></script>


    @if (session('failed'))
        <div id="popup-message" class="popup-message">
            {{ session('failed') }}
        </div>
    @endif

    @if (session('success'))
        <div id="popup-message" class="popup-mess">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div id="error-popup" class="error-popup">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        .message-cell {
            white-space: nowrap;
            width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            /* border: 1px solid #000000; */
        }
    </style>


    <style>
        .hiddendate {
            display: none;
        }

        /* message failed*/
        .popup-message {
            position: fixed;
            top: 20px;
            right: -400px;
            /* Initially off screen */
            width: 300px;
            padding: 15px;
            background-color: #ee1919;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(50%);
            transition: right 0.5s ease-in-out;
            z-index: 9999;
        }

        .popup-message.active {
            right: 20px;
            /* Slide in from the right */
        }

        /* message success*/
        .popup-mess {
            position: fixed;
            top: 20px;
            right: -400px;
            /* Initially off screen */
            width: 300px;
            padding: 15px;
            background-color: #02aa27;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(50%);
            transition: right 0.5s ease-in-out;
            z-index: 9999;
        }

        .popup-mess.active {
            right: 20px;
            /* Slide in from the right */
        }

        /* error */
        .error-popup {
            position: fixed;
            top: 20px;
            right: -400px;
            /* Initially off screen */
            width: 300px;
            padding: 15px;
            background-color: #ee1919;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(50%);
            transition: right 0.5s ease-in-out;
            z-index: 9999;
        }

        .error-popup.active {
            right: 20px;
            /* Slide in from the right */
        }
    </style>
</head>

<body>



    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            {{-- @section('sidebar')

            @show --}}
            @if (auth()->user()->type == 'admin')
                @include('include.sidebar')
            @elseif (auth()->user()->type == 'staff')
                @include('include.classteachersidebar')
            @elseif (auth()->user()->type == 'clerk')
                @include('include.sidebar.clerksidebar')
            @elseif (auth()->user()->type == 'frontoffice')
                @include('include.sidebar.frontofficesidebar')
            @elseif (auth()->user()->type == 'accountant')
                @include('include.sidebar.accountantsidebar')
            @else
                return redirect()->route('home');
            @endif


            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        {{-- <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                    aria-label="Search..." />
                            </div>
                        </div> --}}
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/avatar-1.png" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                       <img src="../assets/img/avatars/avatar-1.png" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted">{{ Auth::user()->type }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    {{-- <li>
                          <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                          </a>
                        </li> --}}

                                    {{-- <li>
                          <div class="dropdown-divider"></div>
                        </li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>

                                    {{-- <li class="menu-item">
                                        <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                                            <div data-i18n="Support">{{ __('Logout') }}</div>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @section('contentdashboard')

                        @show
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">


                                <a href="" target="_blank" class="footer-link fw-bolder"></a>
                            </div>

                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    {{-- toastr --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- build:js assets/vendor/js/core.js -->
    {{-- <script src="assets/vendor/libs/jquery/jquery.js"></script> --}}
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- High chart JS -->
    <!-- {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}} -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet"> --}} -->

    <!-- Page JS -->
    <script src="{{ url('assets/js/dashboards-analytics.js') }}"></script>
    <!-- {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}} -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script> -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>



    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>

    <!-- DataTables Buttons CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css"> -->

    <!-- DataTables Buttons JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!-- Bootstrap CSS (optional, if you are using Bootstrap) -->
    <!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <!-- Bootstrap JS (optional, if you are using Bootstrap) -->
    <script type="text/javascript" charset="utf8"
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





    <script>
        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('ifYes').style.visibility = 'visible';
            } else document.getElementById('ifYes').style.visibility = 'hidden';

        }

        // $(document).ready(function() {
        //     $('#example').DataTable();
        // });

        $(document).ready(function() {
            $('#example').DataTable();
        });
        $(document).ready(function() {
            $('#example1').DataTable();
        });
        $(document).ready(function() {
            $('#example2').DataTable();
        });

        $(document).ready(function() {
            $('#example4').DataTable({
                "order": [
                    [0, 'asc']
                ]
            });
        });
        $(document).ready(function() {
            $('#example5').DataTable({
                "order": [
                    [2, 'desc']
                ]
            });
        });
        $(document).ready(function() {
            $('#example6').DataTable({
                "order": [
                    [2, 'desc']
                ]
            });
        });



        $(document).ready(function() {
            var dataTable = $('#example3').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csvHtml5',
                    text: 'Export to CSV',
                    titleAttr: 'Export to CSV',
                    className: 'btn btn-outline-secondary',
                    exportOptions: {
                        columns: ':not(.exclude-export)' // Exclude columns with the class 'exclude-export'
                    }
                }],
                paging: true, // Enable pagination
                pageLength: 10, // Number of rows per page
                initComplete: function() {
                    console.log('DataTables has been initialized.');

                    // Change the font color of the thead to black
                    $('#example3 thead th').css('color', 'black');

                    // Trigger the CSV export immediately after DataTables initialization
                    // $('#example3').DataTable().buttons(0).trigger();
                }
            });
        });
        $(document).ready(function() {
            var dataTable = $('#example7').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csvHtml5',
                    text: 'Export to CSV',
                    titleAttr: 'Export to CSV',
                    className: 'btn btn-outline-secondary',
                    exportOptions: {
                        columns: ':not(.exclude-export)' // Exclude columns with the class 'exclude-export'
                    }
                }],
                paging: true, // Enable pagination
                pageLength: 10, // Number of rows per page
                initComplete: function() {
                    console.log('DataTables has been initialized.');

                    // Change the font color of the thead to black
                    $('#example3 thead th').css('color', 'black');

                    // Trigger the CSV export immediately after DataTables initialization
                    // $('#example3').DataTable().buttons(0).trigger();
                }
            });
        });


        $(document).ready(function() {
    var dataTable = $('#example8').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'csvHtml5',
            text: 'Export to CSV',
            titleAttr: 'Export to CSV',
            className: 'btn btn-outline-secondary',
            exportOptions: {
                columns: ':not(.exclude-export)' // Exclude columns with the class 'exclude-export'
            }
        }],
        paging: true, // Enable pagination
        pageLength: 10, // Number of rows per page
        searching: true, // Enable search box
        ordering: false, // Enable sorting
        info: true, // Enable info display (page information)
        ordering: false, // Enable sorting
        initComplete: function() {
            console.log('DataTables has been initialized.');

            // Change the font color of the thead to black
            $('#example3 thead th').css('color', 'black');

            // Trigger the CSV export immediately after DataTables initialization
            // $('#example3').DataTable().buttons(0).trigger();
        }
    });
});





        //    message
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('popup-message');

            if (popup) {
                popup.classList.add('active');
                setTimeout(function() {
                    popup.classList.remove('active');
                }, 3000); // Adjust the duration (milliseconds) as needed
            }
        });

        // error
        document.addEventListener('DOMContentLoaded', function() {
            const errorPopup = document.getElementById('error-popup');

            if (errorPopup) {
                errorPopup.classList.add('active');
                setTimeout(function() {
                    errorPopup.classList.remove('active');
                }, 5000); // Adjust the duration (milliseconds) as needed
            }
        });


        // add date
        // document.getElementById('first-dropdown').addEventListener('change', function() {
        //     var anotherInput = document.getElementById('another-input');
        //     if (this.value === '1') {
        //         anotherInput.classList.remove('hiddendate');
        //     } else {
        //         anotherInput.classList.add('hiddendate');
        //     }
        // });

        //         // Get the current date in the "YYYY-MM-DD" format
        //         function getCurrentDate() {
        //      const now = new Date();
        //      const year = now.getFullYear();
        //      const month = String(now.getMonth() + 1).padStart(2, '0');
        //      const day = String(now.getDate()).padStart(2, '0');
        //      return `${year}-${month}-${day}`;
        //  }

        //  // Set the value of the input field to the current date
        //  document.getElementById('automaticDate').value = getCurrentDate();


        // add date
        document.getElementById('first-dropdown').addEventListener('change', function() {
            var anotherInput = document.getElementById('another-input');
            if (this.value === '1') {
                anotherInput.classList.remove('hiddendate');
            } else {
                anotherInput.classList.add('hiddendate');
            }
        });


        // Get the current date in the "YYYY-MM-DD" format
        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Set the value of the input field to the current date
        document.getElementById('automaticDate').value = getCurrentDate();
    </script>
    @stack('other-scripts')
</body>

</html>
