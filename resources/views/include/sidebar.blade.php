<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/admin/home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">

                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                    <mask id="mask-2" fill="white">
                                        <use xlink:href="#path-1"></use>
                                    </mask>
                                    <use fill="#696cff" xlink:href="#path-1"></use>
                                    <g id="Path-3" mask="url(#mask-2)">
                                        <use fill="#696cff" xlink:href="#path-3"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                    </g>
                                    <g id="Path-4" mask="url(#mask-2)">
                                        <use fill="#696cff" xlink:href="#path-4"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                    </g>
                                </g>
                                <g id="Triangle"
                                    transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                    <use fill="#696cff" xlink:href="#path-5"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            @include('include.headingname')
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
        </li>
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/home') ? 'active' : '' }}">
            <a href="{{ url('admin/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{ Request::is('admin/school_info') ? 'active' : '' }}">
            <a href="{{ url('admin/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">STUDENT</span>
        </li>
        <li
            class="menu-item  {{ Request::is('admin/newadmission') || Request::is('admin/newadmissiondetails') || Request::is('students/create') || Request::is('students') || Request::is('addstudent') || Request::is('admin/newadmissionview') || Request::is('admin/newadmissionedit') || Request::is('studentdetails') || Request::is('students/*') || Request::is('admin/newadmissionview/*') || Request::is('admin/newadmissiondetails/filter') || Request::is('admin/studentattendance') || Request::is('admin/studenttakeattendance') || Request::is('admin/monthlycount') ? 'open && active' : '' }}">
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

                <li class="menu-item {{ 'admin/studentattendance' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studentattendance') }}" class="menu-link">
                        <div data-i18n="Fluid">Student Attendance </div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item  {{ Request::is('admin/assignclass_staff_edit/*') || Request::is('admin/assignclass_staff') || Request::is('admin/studentpromotion') || Request::is('admin/sections') || Request::is('admin/studenttimetable') || Request::is('admin/studenttimetableedit/*') || Request::is('admin/classedit/*') || Request::is('admin/stafftimetable') || Request::is('admin/stafftimetableedit/*') ? 'open && active' : '' }}">
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
            class="menu-item  {{ Request::is('admin/paidfees') || Request::is('admin/feesform') || Request::is('admin/dailyfees') || Request::is('admin/monthlyfees') || Request::is('admin/yearlyfees') || Request::is('admin/previousyearfees') || Request::is('admin/previousdayfees') || Request::is('admin/previousmonthfees') ? 'open && active' : '' }}">
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


        <li class="menu-item  {{ Request::is('admin/transport') || Request::is('transport/add') ? 'active' : '' }}">
            <a href="{{ url('admin/transport') }}" class="menu-link">
          
                <i class='menu-icon tf-icons bx bx-bus'></i>
                <div data-i18n="Analytics">Transport Management</div>
            </a>
            <!-- <ul class="menu-sub">
                <li class="menu-item {{ 'admin/dailycontent' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/route') }}" class="menu-link ">
                        <div data-i18n="Without menu">Routes</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/homework' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/homework') }}" class="menu-link ">
                        <div data-i18n="Without menu">Home Work</div>
                    </a>
                </li>
            </ul> -->
        </li>

        <li
            class="menu-item {{ Request::is('admin/dailycontentview/*') || Request::is('admin/dailycontent') || Request::is('admin/homework') || Request::is('admin/homework/*') ? 'open && active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-customize"></i>
                <div data-i18n="Form Elements">Study Material</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/dailycontent' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/dailycontent') }}" class="menu-link ">
                        <div data-i18n="Without menu">Teaching Content</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/homework' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/homework') }}" class="menu-link ">
                        <div data-i18n="Without menu">Home Work</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
        <!-- REPORT -->

        <li
            class="menu-item   {{ Request::is('admin/staffmonthlycount') || Request::is('staffsalaryedit/*') || Request::is('admin/staffsdetails') || Request::is('admin/staffattendanceedit/*') || Request::is('admin/showattendance') || Request::is('admin/takeattendance') || Request::is('staffs/create') || Request::is('staffs/*') || Request::is('staffsalary/filter') || Request::is('staffsalary') || Request::is('admin/staffattendance') || Request::is('staffedit') || Request::is('staffsalaryedit') || Request::is('staffview') || Request::is('staffsalaryview') ? 'open && active' : '' }}">

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
            class="menu-item {{ Request::is('admin/adminloginlist') || Request::is('admin/staffloginlist') || Request::is('admin/adminloginedit/*') || Request::is('admin/staffloginedit/*') || Request::is('admin/studentloginlist') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Form Layouts">Role & Premission </div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item  {{ 'admin/adminloginlist' == request()->path() ? 'active' : '' }}    {{ request()->is('admin/adminloginedit/*') ? 'active' : '' }}  ">
                    <a href="{{ url('admin/adminloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Admin Login</div>
                    </a>
                </li>
                {{-- {{ (strpos(Route::currentRouteName(), 'admin/staffloginlist') == 0) ? 'active' : '' }} --}}
                <li
                    class="menu-item {{ request()->is('admin/staffloginedit/*') ? 'active' : '' }} {{ request()->is('admin/staffloginlist') ? 'active' : '' }}">
                    <a href="{{ url('admin/staffloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Staff Login</div>
                    </a>

                </li>
                <li class="menu-item {{ 'admin/studentloginlist' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studentloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Student Login</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item {{ Request::is('admin/dailyexpense') || Request::is('admin/monthlyexpense') || Request::is('admin/yearlyexpense') || Request::is('admin/enterexpense') || Request::is('admin/expenseedit') || Request::is('admin/previousyear') || Request::is('admin/previousmonth') || Request::is('admin/yearlyexpense') || Request::is('admin/previousexpense') ? 'open && active' : '' }}">
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
        <!-- Exam -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Exam</span></li>
        <!-- Cards -->
        <li
            class="menu-item {{ Request::is('offlineexam') || Request::is('offlineexamedit/*') || Request::is('offlinetimetable') || Request::is('examresult') ? 'open && active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Form Layouts">Exam</div>
            </a>
            <ul class="menu-sub">
                <li {{-- || 'offlinequarterlyexam'  || 'offlinehalflyexam' || 'offlineannualexam' || 'offlineexamedit' --}}
                    class="menu-item {{ 'offlineexam' == request()->path() ? 'active' : '' }}{{ 'offlineexamedit' == request()->path() ? 'active' : '' }} {{ 'offlinetimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('offlinetimetable') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Exam Timetable</div>
                    </a>
                </li>

            </ul>
        </li>

        <li
            class="menu-item {{ Request::is('admin/edit/*') || Request::is('admin/marks/show') || Request::is('admin/index') || Request::is('admin/marks/enter') ? 'open && active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Form Elements">Students Mark</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ 'admin/index' == request()->path() ? 'active' : '' }}{{ 'admin/marks/enter' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/index') }}" class="menu-link ">
                        <div data-i18n="Without menu">Entry Mark</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/marks/show' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/marks/show') }}" class="menu-link ">
                        <div data-i18n="Without menu">Show Result</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">UTILITIES</span></li>
        <!-- REPORT -->
        <li
            class="menu-item {{ Request::is('admin/message') || Request::is('admin/bulkmessage') ? 'open && active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Form Layouts">Message</div>
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
            class="menu-item  {{ Request::is('admin/notice') || Request::is('admin/e_news') ? 'open && active' : '' }}">
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
        <li class="menu-item  {{ Request::is('admin/visitor') ? 'active' : '' }}">
            <a href="{{ url('admin/visitor') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div data-i18n="Analytics">Visitor Management</div>
            </a>
        </li>

        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">REPORT</span></li>
        <!-- REPORT -->
        <li class="menu-item  {{ Request::is('admin/completedstudents') || Request::is('admin/studentscount') || Request::is('admin/getClassAttendance') || Request::is('admin/transferstudents') ? 'open && active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Student</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'admin/completedstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/completedstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">completed</div>
                    </a>
                </li>

                <li class="menu-item {{ 'admin/transferstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/transferstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">Transfer</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/getClassAttendance' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/getClassAttendance') }}" class="menu-link">
                        <div data-i18n="Without menu">Student Attendance</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/studentscount' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/studentscount') }}" class="menu-link">
                        <div data-i18n="Without menu">Students Count</div>
                    </a>
                </li>
            </ul>
        </li>

        <li  class="menu-item  {{ Request::is('admin/getvehiclereport') || Request::is('admin/getstudentreport')  ? 'open && active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Transport</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ 'admin/getvehiclereport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/getvehiclereport') }}" class="menu-link">
                        <div data-i18n="Without menu">Vehicle Report</div>
                    </a>
                </li>
                <li class="menu-item {{ 'admin/getstudentreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/getstudentreport') }}" class="menu-link">
                        <div data-i18n="Without menu">Student In Route</div>
                    </a>
                </li>

               
            </ul>
        </li>

        <li class="menu-item {{ Request::is('admin/feesdetailsreport', 'admin/getfeesreport', 'admin/getstudentreport') ? 'open && active' : '' }}">          
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Fees</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{  'admin/getfeesreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/getfeesreport') }}" class="menu-link">
                        <div data-i18n="Without menu">Fees Report</div>
                    </a>
                </li>
               
               
            </ul>
        </li>
        <li class="menu-item {{ Request::is('admin/staffsdetailsreport', 'admin/getstaffreport', 'admin/getstudentreport') ? 'open && active' : '' }}">            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Staff</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{  'admin/getstaffreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/getstaffreport') }}" class="menu-link">
                        <div data-i18n="Without menu">Staffs Report</div>
                    </a>
                </li>
               
               
            </ul>
        </li>
        <!-- SETTINGS SECTION -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">SETTINGS SECTION</span></li>
        <li
            class="menu-item {{ Request::is('admin/examtimeedit/*') || Request::is('admin/classtimeedit/*') || Request::is('admin/schoolinfoedit/*') || Request::is('admin/time') || Request::is('subjects/create') || Request::is('examtypes/create') || Request::is('admin/administrativedetails') || Request::is('subjects') || Request::is('admin/administrativeedit/*') || Request::is('examtypes') || Request::is('examtypes/*/edit') || Request::is('subjects/*/edit') ? 'open && active' : '' }} ">
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
            </ul>
        </li>
    </ul>
</aside>
