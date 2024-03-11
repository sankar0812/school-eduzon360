{{-- clerk --}}

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('/clerk/home') }}" class="">

            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('clerk/home') ? 'open' : '' }}">
            <a href="{{ url('clerk/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- School Information-->
        <li class="menu-item  {{ Request::is('clerk/school_info') ? 'open' : '' }}">
            <a href="{{ url('clerk/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>
        <!-- User interface -->
        <li
            class="menu-item  {{ Request::is('clerk/students/*') || Request::is('clerk/newadmissiondetails/filter') || Request::is('clerk/newadmission') || Request::is('clerk/newadmissiondetails') || Request::is('clerk/students/create') || Request::is('clerk/students') || Request::is('clerk/addstudent') || Request::is('clerk/newadmissionview/*') || Request::is('clerk/newadmissionedit') || Request::is('clerk/studentdetails') || Request::is('clerk/studentpromotion') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-face"></i>

                <div data-i18n="User interface">Student Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/newadmission' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/newadmission') }}" class="menu-link">
                        <div data-i18n="Fluid">New Admission</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/newadmissiondetails' == request()->path() ? 'active' : '' }}{{ 'clerk/newadmissionadd' == request()->path() ? 'active' : '' }}{{ 'clerk/newadmissionview' == request()->path() ? 'active' : '' }}{{ 'clerk/newadmissionedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/newadmissiondetails') }}" class="menu-link">
                        <div data-i18n="Fluid">New Admission Details</div>
                    </a>
                </li>
                <li class="menu-item {{ 'clerk/students/create' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/students/create') }}" class="menu-link">
                        <div data-i18n="Fluid">Add Student</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/students' == request()->path() ? 'active' : '' }} {{ 'clerk/studentedit' == request()->path() ? 'active' : '' }} {{ 'clerk/studentview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/students') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Details</div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item   {{ Request::is('clerk/staffmonthlycount') || Request::is('clerk/staffsdetails') || Request::is('clerk/showattendance') || Request::is('clerk/staffsalary/filter') || Request::is('clerk/staffattendanceedit/*') || Request::is('clerk/filterattendance') || Request::is('clerk/takeattendance') || Request::is('clerk/staffs/create') || Request::is('clerkstaffs/*') || Request::is('clerk/staffsalary') || Request::is('clerk/staffattendance') || Request::is('clerk/staffs/*/*') || Request::is('clerk/staffsalaryedit/*/*') || Request::is('clerk/staffview') || Request::is('clerk/staffsalaryview') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-street-view"></i>
                <div data-i18n="Account Settings">Staff Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/staffs/create' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffs/create') }}" class="menu-link">
                        <div data-i18n="Container">Add Staff</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/staffsdetails' == request()->path() ? 'active' : '' }} {{ 'clerk/staffedit' == request()->path() ? 'active' : '' }} {{ 'clerk/staffview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffsdetails') }}" class="menu-link">
                        <div data-i18n="Account">Staff Details</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/staffsalary' == request()->path() ? 'active' : '' }} {{ 'clerk/staffsalaryedit/*/*' == request()->path() ? 'active' : '' }}  {{ 'clerk/staffsalaryview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffsalary') }}" class="menu-link">
                        <div data-i18n="Notifications">Staff Salary</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/monthlycount' == request()->path() ? 'active' : '' }} {{ 'clerk/staffattendance' == request()->path() ? 'active' : '' }} {{ 'clerk/showattendance' == request()->path() ? 'active' : '' }} {{ 'clerk/takeattendance' == request()->path() ? 'active' : '' }} {{ 'clerk/filterattendance' == request()->path() ? 'active' : '' }}{{ 'clerk/staffattendanceedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffattendance') }}" class="menu-link">
                        <div data-i18n="Notifications">Staff Attendance</div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item  {{ Request::is('clerk/assignclass_staff_edit/*') || Request::is('clerk/assignclass_staff') || Request::is('clerk/classedit/*') || Request::is('clerk/studentpromotion') || Request::is('clerk/sections') || Request::is('clerk/studenttimetable') || Request::is('clerk/studenttimetableedit') || Request::is('clerk/stafftimetable') || Request::is('clerk/stafftimetableedit') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="User interface">Class Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/sections' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/sections') }}" class="menu-link ">
                        <div data-i18n="Without menu">Class /Section</div>
                    </a>
                </li>
                <li class="menu-item {{ 'clerk/assignclass_staff' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('clerk/assignclass_staff') }}" class="menu-link">
                        <div data-i18n="Without navbar">Assign Class_staff</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/studenttimetable' == request()->path() ? 'active' : '' }} {{ 'clerk/studenttimetableedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/studenttimetable') }}" class="menu-link">
                        <div data-i18n="Without navbar">Student TimeTable</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/stafftimetable' == request()->path() ? 'active' : '' }} {{ 'clerk/stafftimetableedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/stafftimetable') }}" class="menu-link">
                        <div data-i18n="Without navbar">Staff TimeTable</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'clerk/studentpromotion' == request()->path() ? 'active' : '' }} {{ 'studentd' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/studentpromotion') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Promotion</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item {{ Request::is('clerk/staffloginlist') || Request::is('clerk/staffloginedit/*') || Request::is('clerk/studentloginlist') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Form Layouts">Login Management</div>
            </a>
            <ul class="menu-sub">
                {{-- {{ (strpos(Route::currentRouteName(), 'clerk/staffloginlist') == 0) ? 'active' : '' }} --}}
                <li
                    class="menu-item {{ request()->is('clerk/staffloginedit/*') ? 'active' : '' }} {{ request()->is('clerk/staffloginlist') ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Staff List</div>
                    </a>

                </li>
                <li class="menu-item {{ 'clerk/studentloginlist' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/studentloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Student List</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-item  {{ Request::is('clerk/notice') || Request::is('clerk/e_news') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Extended UI">Organization</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/notice' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/notice') }}" class="menu-link">
                        <div data-i18n="Without menu">School Notice</div>
                    </a>
                </li>

                <li class="menu-item {{ 'clerk/e_news' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/e_news') }}" class="menu-link">
                        <div data-i18n="Without menu">School E-New</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item  {{ Request::is('clerk/completedstudents') || Request::is('clerk/transferstudents') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/completedstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/completedstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">completed Students</div>
                    </a>
                </li>

                <li class="menu-item {{ 'clerk/transferstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/transferstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">Transfer Students</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('clerk/message') ||  Request::is('clerk/bulkmessage') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Form Layouts">Message Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/message' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/message') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Staff Message</div>
                    </a>
                </li>
                <li class="menu-item {{ 'clerk/bulkmessage' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('clerk/bulkmessage') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Bulk class Message </div>
                    </a>
                </li>

            </ul>
        </li>
        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}

        <li class="menu-item">
            <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Support">{{ __('Logout') }}</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>

{{-- account --}}

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('accountant/home') }}" class="">

            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('accountant/home') ? 'open' : '' }}">
            <a href="{{ url('accountant/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- School Information-->
        <li
            class="menu-item  {{ Request::is('accountant/school_info') || Request::is('accountant/administrativeedit/{id}') ? 'open' : '' }}">
            <a href="{{ url('accountant/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>
        <!-- User interface -->


        <li
            class="menu-item  {{ Request::is('accountant/paidfees') || Request::is('accountant/feesform') || Request::is('accountant/dailyfees') || Request::is('accountant/monthlyfees') || Request::is('accountant/yearlyfees') || Request::is('accountant/previousyearfees') || Request::is('accountant/previousdayfees') || Request::is('accountant/previousmonthfees') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-rupee"></i>
                <div data-i18n="Form Elements">Fees Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'accountant/feesform' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('accountant/feesform') }}" class="menu-link">
                        <div data-i18n="Basic Inputs">Fees Form</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'accountant/dailyfees' == request()->path() ? 'active' : '' }} {{ 'accountant/monthlyfees' == request()->path() ? 'active' : '' }}  {{ 'accountant/yearlyfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('accountant/dailyfees') }}" class="menu-link">
                        <div data-i18n="Input groups">Fees Details</div>
                    </a>
                </li>
                <li class="menu-item {{ 'accountant/paidfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('accountant/paidfees') }}" class="menu-link">
                        <div data-i18n="Input groups">student paid details</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item {{ Request::is('accountant/dailyexpense') || Request::is('accountant/monthlyexpense') || Request::is('accountant/yearlyexpense') || Request::is('accountant/enterexpense') || Request::is('accountant/expenseedit/*') || Request::is('accountant/previousyear') || Request::is('accountant/previousyear') || Request::is('accountant/previousmonth') || Request::is('accountant/yearlyexpense') || Request::is('accountant/previousexpense') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Form Layouts">Expense Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'accountant/enterexpense' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('accountant/enterexpense') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Expense Enter</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'accountant/dailyexpense' == request()->path() ? 'active' : '' }} {{ 'accountant/monthlyexpense' == request()->path() ? 'active' : '' }} {{ 'accountant/yearlyexpense' == request()->path() ? 'active' : '' }} {{ 'accountant/expenseedit/*' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('accountant/dailyexpense') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Expense Details</div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}

        <li class="menu-item">
            <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Support">{{ __('Logout') }}</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>

{{-- front --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('frontoffice/home') }}" class="">

            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('frontoffice/home') ? 'open' : '' }}">
            <a href="{{ url('frontoffice/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- School Information-->
        <li
            class="menu-item  {{ Request::is('frontoffice/school_info') || Request::is('frontoffice/administrativeedit/{id}') ? 'open' : '' }}">
            <a href="{{ url('frontoffice/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>
        <!-- User interface -->

        <li class="menu-item  {{ Request::is('frontoffice/visitor') ? 'open' : '' }}">
            <a href="{{ url('frontoffice/visitor') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Visitor Management</div>
            </a>
        </li>


        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}

        <li class="menu-item">
            <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Support">{{ __('Logout') }}</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>



{{-- admin --}}

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/admin/home') }}" class="">

            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('admin/home') ? 'open' : '' }}">
            <a href="{{ url('admin/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- School Information-->
        <li
            class="menu-item  {{ Request::is('admin/school_info') || Request::is('admin/administrativeedit/{id}') ? 'open' : '' }}">
            <a href="{{ url('admin/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>
        <!-- User interface -->
        <li
            class="menu-item  {{ Request::is('admin/newadmission') || Request::is('admin/newadmissiondetails') || Request::is('students/create') || Request::is('students') || Request::is('addstudent') || Request::is('admin/newadmissionview') || Request::is('admin/newadmissionedit') || Request::is('studentdetails') || Request::is('students/*') || Request::is('admin/newadmissionview/*') || Request::is('admin/newadmissiondetails/filter') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-face"></i>

                <div data-i18n="User interface">Student Management</div>
            </a>


            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/newadmission' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/newadmission') }}" class="menu-link">
                        <div data-i18n="Fluid">New Admission</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/newadmissiondetails' == request()->path() ? 'active' : '' }}{{ 'admin/newadmissionadd' == request()->path() ? 'active' : '' }}{{ 'admin/newadmissionview' == request()->path() ? 'active' : '' }}{{ 'admin/newadmissionedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/newadmissiondetails') }}" class="menu-link">
                        <div data-i18n="Fluid">New Admission Details</div>
                    </a>
                </li>
                <li class="menu-item {{ 'students/create' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('students/create') }}" class="menu-link">
                        <div data-i18n="Fluid">Add Student</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'students' == request()->path() ? 'active' : '' }} {{ 'studentedit' == request()->path() ? 'active' : '' }} {{ 'studentview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('students') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Details</div>
                    </a>
                </li>
                {{-- <li
                    class="menu-item {{ 'studentattendance' == request()->path() ? 'active' : '' }} {{ 'studenttakeattendance' == request()->path() ? 'active' : '' }}{{ 'studentattendance' == request()->path() ? 'active' : '' }}{{ 'studentfilterattendance' == request()->path() ? 'active' : '' }} {{ 'studentattendanceedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('studentattendance') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Attendance</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'studentfees' == request()->path() ? 'active' : '' }}{{ 'studentfeesedit' == request()->path() ? 'active' : '' }}{{ 'studentfeesview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('studentfees') }}" class="menu-link">
                        <div data-i18n="Alerts">Student Fees</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'studentpromotion' == request()->path() ? 'active' : '' }} {{ 'studentd' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('studentpromotion') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Promotion</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li
            class="menu-item   {{ Request::is('admin/staffmonthlycount') || Request::is('staffsalaryedit/*') || Request::is('admin/staffsdetails') || Request::is('admin/staffattendanceedit/*') || Request::is('admin/showattendance') || Request::is('admin/takeattendance') || Request::is('staffs/create') || Request::is('staffs/*') || Request::is('staffsalary/filter') || Request::is('staffsalary') || Request::is('admin/staffattendance') || Request::is('staffedit') || Request::is('staffsalaryedit') || Request::is('staffview') || Request::is('staffsalaryview') ? 'open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-street-view"></i>
                <div data-i18n="Account Settings">Staff Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'staffs/create' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('staffs/create') }}" class="menu-link">
                        <div data-i18n="Container">Add Staff</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/staffsdetails' == request()->path() ? 'active' : '' }} {{ 'staffs/*' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/staffsdetails') }}" class="menu-link">
                        <div data-i18n="Account">Staff Details</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'staffsalary' == request()->path() ? 'active' : '' }} {{ 'staffsalaryedit' == request()->path() ? 'active' : '' }}  {{ 'staffsalaryview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('staffsalary') }}" class="menu-link">
                        <div data-i18n="Notifications">Staff Salary</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/monthlycount' == request()->path() ? 'active' : '' }}  {{ 'admin/staffattendance' == request()->path() ? 'active' : '' }} {{ 'admin/takeattendance' == request()->path() ? 'active' : '' }} {{ 'admin/showattendance' == request()->path() ? 'active' : '' }}{{ 'admin/staffattendanceedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/staffattendance') }}" class="menu-link">
                        <div data-i18n="Notifications">Staff Attendance</div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item  {{ Request::is('admin/assignclass_staff_edit/*') || Request::is('admin/assignclass_staff') || Request::is('admin/studentpromotion') || Request::is('admin/sections') || Request::is('admin/studenttimetable') || Request::is('admin/studenttimetableedit/*') || Request::is('admin/classedit/*') || Request::is('admin/stafftimetable') || Request::is('admin/stafftimetableedit/*') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="User interface">Class Management</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ 'admin/sections' == request()->path() ? 'active' : '' }}{{ 'admin/classedit/*' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/sections') }}" class="menu-link ">
                        <div data-i18n="Without menu">Class /Section</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/assignclass_staff' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('admin/assignclass_staff') }}" class="menu-link">
                        <div data-i18n="Without navbar">Assign Class_staff</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/studenttimetable' == request()->path() ? 'active' : '' }} {{ 'admin/studenttimetableedit/*' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studenttimetable') }}" class="menu-link">
                        <div data-i18n="Without navbar">Student TimeTable</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/stafftimetable' == request()->path() ? 'active' : '' }} {{ 'admin/stafftimetableedit/*' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/stafftimetable') }}" class="menu-link">
                        <div data-i18n="Without navbar">Staff TimeTable</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/studentpromotion' == request()->path() ? 'active' : '' }} {{ 'student' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studentpromotion') }}" class="menu-link">
                        <div data-i18n="Accordion">Student Promotion</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item  {{ Request::is('admin/paidfees') || Request::is('admin/feesform') || Request::is('admin/dailyfees') || Request::is('admin/monthlyfees') || Request::is('admin/yearlyfees') || Request::is('admin/previousyearfees') || Request::is('admin/previousdayfees') || Request::is('admin/previousmonthfees') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-rupee"></i>
                <div data-i18n="Form Elements">Fees Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/feesform' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('admin/feesform') }}" class="menu-link">
                        <div data-i18n="Basic Inputs">Fees Form</div>
                    </a>
                </li>
                <!-- <li
                    class="menu-item {{ 'admin/dailyfees' == request()->path() ? 'active' : '' }} {{ 'admin/monthlyfees' == request()->path() ? 'active' : '' }}  {{ 'admin/yearlyfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('admin/dailyfees') }}" class="menu-link">
                        <div data-i18n="Input groups">Fees Details</div>
                    </a>
                </li> -->
                <li class="menu-item {{ 'admin/paidfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('admin/paidfees') }}" class="menu-link">
                        <div data-i18n="Input groups">student Fees paid details</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ Request::is('offlineexam') || Request::is('offlineexamedit/*') || Request::is('offlinetimetable') || Request::is('examresult') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Form Layouts">Exam Management</div>
            </a>
            <ul class="menu-sub">
                <li {{-- || 'offlinequarterlyexam'  || 'offlinehalflyexam' || 'offlineannualexam' || 'offlineexamedit' --}}
                    class="menu-item {{ 'offlineexam' == request()->path() ? 'active' : '' }}{{ 'offlineexamedit' == request()->path() ? 'active' : '' }} {{ 'offlinetimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('offlinetimetable') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Exam Timetable</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ 'examresult' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('examresult') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Exam Result</div>
                    </a>
                </li> --}}

            </ul>
        </li>

        <!-- Transport -->
        <li class="menu-item  {{ Request::is('admin/transport') || Request::is('transport/add') ? 'open' : '' }}">
            <a href="{{ url('admin/transport') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-bus'></i>
                <div data-i18n="Analytics">Transport Management</div>
            </a>
        </li>





        <li
            class="menu-item {{ Request::is('admin/adminloginlist') || Request::is('admin/staffloginlist') || Request::is('admin/adminloginedit/*') || Request::is('admin/staffloginedit/*') || Request::is('admin/studentloginlist') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Form Layouts">Login Management</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item  {{ 'admin/adminloginlist' == request()->path() ? 'active' : '' }}    {{ request()->is('admin/adminloginedit/*') ? 'active' : '' }}  ">
                    <a href="{{ url('admin/adminloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Admin List</div>
                    </a>
                </li>
                {{-- {{ (strpos(Route::currentRouteName(), 'admin/staffloginlist') == 0) ? 'active' : '' }} --}}
                <li
                    class="menu-item {{ request()->is('admin/staffloginedit/*') ? 'active' : '' }} {{ request()->is('admin/staffloginlist') ? 'active' : '' }}">
                    <a href="{{ url('admin/staffloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Staff List</div>
                    </a>

                </li>
                <li class="menu-item {{ 'admin/studentloginlist' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studentloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Student List</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li
            class="menu-item  {{ Request::is('vehicledetailsedit') || Request::is('vehicleexpenseedit') || Request::is('vehicledetails') || Request::is('studentlist') || Request::is('vechicleexpense') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-bus"></i>
                <div data-i18n="Extended UI">Transport Management</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ 'vehicledetails' == request()->path() ? 'active' : '' }} {{ 'vehicledetailsedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('vehicledetails') }}" class="menu-link">
                        <div data-i18n="Without menu">Vehicle Details</div>
                    </a>
                </li>
                <li class="menu-item {{ 'studentlist' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('studentlist') }}" class="menu-link">
                        <div data-i18n="Without navbar">Student List</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'vechicleexpense' == request()->path() ? 'active' : '' }} {{ 'vehicleexpenseedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('vechicleexpense') }}" class="menu-link">
                        <div data-i18n="Without menu">Vehicle Expense</div>
                    </a>
                </li>

            </ul>
        </li> --}}
        <!-- Extended components -->
        {{-- <li
            class="menu-item   {{ Request::is('returndetails') || Request::is('stockpurchase') || Request::is('stockreturn') || Request::is('stockdetails') || Request::is('stockusage') || Request::is('stockout') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                <div data-i18n="Extended UI">Stock Management</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ 'stockpurchase' == request()->path() ? 'active' : '' }} {{ 'stockreturn' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('stockpurchase') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Purchase/Return</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'stockdetails' == request()->path() ? 'active' : '' }}  {{ 'returndetails' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('stockdetails') }}" class="menu-link">
                        <div data-i18n="Text Divider">Details</div>
                    </a>
                </li>

                <li
                    class="menu-item {{ 'stockusage' == request()->path() ? 'active' : '' }} {{ 'stockout' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('stockusage') }}" class="menu-link">
                        <div data-i18n="Text Divider">Stock Usage</div>
                    </a>
                </li>

            </ul>
        </li> --}}

        <li
            class="menu-item {{ Request::is('admin/dailyexpense') || Request::is('admin/monthlyexpense') || Request::is('admin/yearlyexpense') || Request::is('admin/enterexpense') || Request::is('admin/expenseedit') || Request::is('admin/previousyear') || Request::is('admin/previousmonth') || Request::is('admin/yearlyexpense') || Request::is('admin/previousexpense') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Form Layouts">Expense Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/enterexpense' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/enterexpense') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Expense Enter</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'admin/dailyexpense' == request()->path() ? 'active' : '' }} {{ 'admin/monthlyexpense' == request()->path() ? 'active' : '' }} {{ 'admin/yearlyexpense' == request()->path() ? 'active' : '' }} {{ 'admin/expenseedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/dailyexpense') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Expense Details</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item  {{ Request::is('admin/visitor') ? 'open' : '' }}">
            <a href="{{ url('admin/visitor') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div data-i18n="Analytics">Visitor Management</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('admin/notice') || Request::is('admin/e_news') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Extended UI">Organization</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/notice' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/notice') }}" class="menu-link">
                        <div data-i18n="Without menu">School Notice</div>
                    </a>
                </li>

                <li class="menu-item {{ 'admin/e_news' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/e_news') }}" class="menu-link">
                        <div data-i18n="Without menu">School E-New</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item  {{ Request::is('admin/completedstudents') || Request::is('admin/transferstudents') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/completedstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/completedstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">completed Students</div>
                    </a>
                </li>

                <li class="menu-item {{ 'admin/transferstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/transferstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">Transfer Students</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('admin/message') || Request::is('admin/bulkmessage') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Form Layouts">Message Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/message' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/message') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Staff Message</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/bulkmessage' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('admin/bulkmessage') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Bulk class Message </div>
                    </a>
                </li>

            </ul>
        </li>

        <li
            class="menu-item {{ Request::is('admin/examtimeedit/*') || Request::is('admin/classtimeedit/*') || Request::is('admin/schoolinfoedit/*') || Request::is('admin/time') ? 'open' : '' }} {{ Request::is('subjects/create') ? 'open' : '' }} {{ Request::is('examtypes/create') ? 'open' : '' }} {{ Request::is('admin/administrativedetails') ? 'open' : '' }}  {{ Request::is('subjects') ? 'open' : '' }} {{ Request::is('admin/administrativeedit/*') ? 'open' : '' }} {{ Request::is('examtypes') ? 'open' : '' }} ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Form Layouts">General Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/administrativedetails' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/administrativedetails') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Administrative Details</div>
                    </a>
                </li>

                <li class="menu-item {{ 'subjects' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('subjects') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Subjects</div>
                    </a>
                </li>
                <li class="menu-item {{ 'examtypes' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('examtypes') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Exam Type</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/time' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/time') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Times</div>
                    </a>
                </li>
                {{-- <li
                    class="menu-item {{ 'dailyexpense' == request()->path() ? 'active' : '' }} {{ 'monthlyexpense' == request()->path() ? 'active' : '' }} {{ 'yearlyexpense' == request()->path() ? 'active' : '' }} {{ 'expenseedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('dailyexpense') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Expense Details</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        {{-- <li
            class="menu-item {{ Request::is('dailyexpense') || Request::is('monthlyexpense') || Request::is('yearlyexpense') || Request::is('enterexpense') || Request::is('expenseedit') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-book"></i>
                <div data-i18n="Form Layouts">Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'enterexpense' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('enterexpense') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Expense Enter</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'dailyexpense' == request()->path() ? 'active' : '' }} {{ 'monthlyexpense' == request()->path() ? 'active' : '' }} {{ 'yearlyexpense' == request()->path() ? 'active' : '' }} {{ 'expenseedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('dailyexpense') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Expense Details</div>
                    </a>
                </li>
            </ul>
        </li> --}}



        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}

        <li class="menu-item">
            <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Support">{{ __('Logout') }}</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>


{{-- stafff --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('/classteacher/home') }}" class="">
            <span class="app-brand-text  demo menu-text fw-bolder ms-2">SMS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('classteacher/home') ? 'open' : '' }}">
            <a href="{{ url('/classteacher/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
            </a>
        </li>
        <li
            class="menu-item {{ Request::is('classteacher/edit/*') || Request::is('marks/show') || Request::is('classteacher/index') || Request::is('marks/enter') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Form Elements">Students Mark</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ 'classteacher/index' == request()->path() ? 'active' : '' }}{{ 'marks/enter' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/index') }}" class="menu-link ">
                        <div data-i18n="Without menu">Entry Mark</div>
                    </a>
                </li>
                <li class="menu-item {{ 'marks/show' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('marks/show') }}" class="menu-link ">
                        <div data-i18n="Without menu">Show Result</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- //student attendance -->
        <?php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Auth;

        // Get the ID of the currently authenticated user
        $id = Auth::user()->id;

        // Query the 'staff' table to fetch a record where 'login_id' matches $id
        $staff = DB::table('staff')
            ->where('login_id', $id)
            ->first();

        // Query the 'class_sections' table to fetch records meeting certain conditions
        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->select('c_teacherid')
            ->get();
        ?>

        @if ($class->contains('c_teacherid', $staff->id))
            <!-- If there are matching class sections, do nothing -->
       <li
                class="menu-item {{ Request::is('classteacher/monthlycount') || Request::is('classteacher/studentattendance') || Request::is('classteacher/studentattendanceedit') || Request::is('classteacher/studenttakeattendance') || Request::is('classteacher/studentfilterattendance') ? 'open' : '' }} ">
                <a href="{{ url('classteacher/studentattendance') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-select-multiple"></i>
                    <div data-i18n="Analytics">Student Attendance </div>
                </a>
            </li>
        @else
            <!-- If there are no matching class sections, display this menu item -->
            <!-- Add code for the case when there are no matching class sections -->
        @endif

<!-- //student Details -->
@if ($class->contains('c_teacherid', $staff->id))
            <li
                class="menu-item  {{ Request::is('classteacher/studentdetailslist') || Request::is('classteacher/studentdetailsview/*') ? 'open' : '' }}">
                <a href="{{ url('classteacher/studentdetailslist') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-paste"></i>
                    <div data-i18n="Analytics">Student Details</div>
                </a>
            </li>
        @else
            <!-- If there are no matching class sections, display this menu item -->
            <!-- Add code for the case when there are no matching class sections -->
        @endif

<!-- //study Material -->
<li
        class="menu-item {{ Request::is('classteacher/dailycontentview/*') || Request::is('classteacher/dailycontent') || Request::is('classteacher/homework') || Request::is('classteacher/homework/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-customize"></i>
            <div data-i18n="Form Elements">Study Material</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ 'classteacher/dailycontent' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('classteacher/dailycontent') }}" class="menu-link ">
                    <div data-i18n="Without menu">Teaching Content</div>
                </a>
            </li>
            <li class="menu-item {{ 'classteacher/homework' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('classteacher/homework') }}" class="menu-link ">
                    <div data-i18n="Without menu">Home Work</div>
                </a>
            </li>
        </ul>
    </li>


        <!-- Layouts -->
        <li
            class="menu-item {{ Request::is('classteacher/dailytimetable') || Request::is('classteacher/studenttimetable') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Form Elements">TimeTable Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'classteacher/dailytimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/dailytimetable') }}" class="menu-link ">
                        <div data-i18n="Without menu">daily Timetable</div>
                    </a>
                </li>
                <li class="menu-item {{ 'classteacher/studenttimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/studenttimetable') }}" class="menu-link ">
                        <div data-i18n="Without menu">Student Timetable</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Staff</span>
      </li> --}}
        {{-- <li
            class="menu-item  {{ (Request::is('classteacher/message') ? 'open' : '' || Request::is('classteacher/sent')) ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link" href="{{ url('classteacher/message') }}">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="User interface">Message </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'classteacher/inbox' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/inbox') }}" class="menu-link">
                        <div data-i18n="Accordion">Inbox</div>
                    </a>
                </li>
                <li class="menu-item {{ 'classteacher/sent' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/sent') }}" class="menu-link">
                        <div data-i18n="Without navbar">Sent</div>
                    </a>
                </li>
            </ul>
        </li> --}}


        <li class="menu-item   {{ Request::is('classteacher/myattendance') ? 'open' : '' }}">
            <a href="{{ url('classteacher/myattendance') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-check"></i>
                <div data-i18n="Analytics">My Attendance</div>
            </a>
        </li>
<!-- //message -->
<li class="menu-item   {{ Request::is('classteacher/message') ? 'open' : '' }}">
            <a href="{{ url('classteacher/message') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Analytics">Message</div>
            </a>
        </li>
        {{-- <li
            class="menu-item  {{ Request::is('classteacher/dailycontentview/*') || Request::is('classteacher/dailycontent') ? 'open' : '' }}">
            <a href="{{ url('classteacher/dailycontent') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-customize"></i>
                <div data-i18n="Analytics">Daily Teching Content</div>
            </a>
        </li> --}}


        {{-- <li class="menu-item  {{ Request::is('classteacher/report') ? 'open' : '' }}">
            <a href="{{ url('classteacher/report') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book"></i>
                <div data-i18n="Analytics">Report Management</div>
            </a>
        </li> --}}
        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}

        <li class="menu-item">
            <a href="{{ route('logout') }}" target="_blank" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Support">{{ __('Logout') }}</div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</aside>
