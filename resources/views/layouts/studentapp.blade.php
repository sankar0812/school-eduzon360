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

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
         integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
     <!-- Icons. Uncomment required icon fonts -->
     <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />

     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" > --}}
     <!-- Core CSS -->
     <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
     <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}"
         class="template-customizer-theme-css" />
     <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />
     <link rel="stylesheet" href="{{ url('assets/vendor/css/democal.css') }}" />
     <!-- Vendors CSS -->
     <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

     <link rel="stylesheet" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

     <!-- Page CSS -->

     <!-- Helpers -->
     <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>

     <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
     <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
     <script src="{{ url('assets/js/config.js') }}"></script>

     @if (session('success'))
         <div id="popup-message" class="popup-message">
             {{ session('success') }}
         </div>
     @endif


     <style>
         .hiddendate {
             display: none;
         }

         .popup-message {
             position: fixed;
             top: 0;
             right: -350px;
             /* Initially off screen */
             width: 320px;
             padding: 20px;
             background-color: #405ac4;
             color: #fff;
             border-radius: 10px 0 0 10px;
             font-size: 18px;
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
             transform: translateY(50%);
             transition: right 0.5s ease-in-out;
             z-index: 9999;
         }

         .popup-message.active {
             right: 0;
             /* Slide in from the right */
         }
     </style>
 </head>

 <body>



     <!-- Layout wrapper -->
     <div class="layout-wrapper layout-content-navbar">
         <div class="layout-container">
             <!-- Menu -->
             @include('include.studentsiderbar')


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
                         <div class="navbar-nav align-items-center">
                             <div class="nav-item d-flex align-items-center">
                                 <h5>@yield('title')</h5>

                             </div>
                         </div>
                         <!-- /Search -->

                         <ul class="navbar-nav flex-row align-items-center ms-auto">
                             <!-- Place this tag where you want the button to render. -->


                             <!-- User -->
                             {{ session('studentname') }}
                             <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                     data-bs-toggle="dropdown">
                                     <div class="avatar-online">

                                     </div>
                                 </a>
                                 {{-- <ul class="dropdown-menu dropdown-menu-end">
                                     <li>
                                         <a class="dropdown-item" href="#">
                                             <div class="d-flex">
                                                 <div class="flex-shrink-0 me-3">
                                                     <div class="avatar avatar-online">
                                                         <i class="fa-solid fa-user fa-lg"></i>
                                                     </div>
                                                 </div>
                                                 <div class="flex-grow-1">
                                                     <span class="fw-semibold d-block"></span>
                                                     {{ session('studentname') }}
                                                     <small class="text-muted"></small>
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
                                     <li>
                                         <a class="dropdown-item" href="#">
                                             <i class="bx bx-cog me-2"></i>
                                             <span class="align-middle">Settings</span>
                                         </a>
                                     </li>

                                     <li>
                                         <div class="dropdown-divider"></div>
                                     </li>

                                     <li>
                                         @if (session()->has('studentid'))
                                             <a href="{{ route('student.logout') }}" class="dropdown-item">
                                                 <i class="bx bx-power-off me-2"></i><span class="align-middle">
                                                     {{ __('Logout') }}</span>
                                                 <form id="logout-form" action="{{ route('student.logout') }}"
                                                     method="POST" class="d-none">
                                                     @csrf
                                                 </form>
                                             </a>
                                         @else
                                             <a href="{{ url('student_login') }}">
                                                 <i class="fa fa-sign-out"></i>
                                                 {{ __('Login') }}
                                             </a>
                                         @endif

                                     </li>
                                 </ul> --}}
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
                         @section('studentdashboard')

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

     <!-- Page JS -->
     <script src="{{ url('assets/js/dashboards-analytics.js') }}"></script>
     {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>





     <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"> -->
    </script>

    <!-- DataTables Buttons CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css"> -->

    <!-- DataTables Buttons JS -->
    <!-- <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"> -->
    </script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css"> -->

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

         $(document).ready(function() {
             $('#example').DataTable();
         });

         $(document).ready(function() {
             $('#examples').DataTable();
         });

         $(document).ready(function() {
             $('#example1').DataTable();
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

         // return message
         document.addEventListener('DOMContentLoaded', function() {
             const popup = document.getElementById('popup-message');

             if (popup) {
                 popup.classList.add('active');
                 setTimeout(function() {
                     popup.classList.remove('active');
                 }, 3000); // Adjust the duration (milliseconds) as needed
             }
         });

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

 </body>

 </html>
