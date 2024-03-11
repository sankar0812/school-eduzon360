<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/clerk/home') }}" class="app-brand-link">
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
        <li class="menu-item  {{ Request::is('clerk/home') ? 'active' : '' }}">
            <a href="{{ url('clerk/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item  {{ Request::is('clerk/school_info') ? 'active' : '' }}">
            <a href="{{ url('clerk/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">STUDENT</span>
        </li>
        <li
            class="menu-item   {{ Request::is('clerk/newadmission') || Request::is('clerk/newadmissiondetails') || Request::is('clerk/students/create') || Request::is('clerk/students') || Request::is('addstudent') || Request::is('clerk/newadmissionview') || Request::is('clerk/newadmissionedit') || Request::is('studentdetails') || Request::is('clerk/students/*') || Request::is('clerk/newadmissionview/*') || Request::is('clerk/newadmissiondetails/filter') ? 'open && active' : '' }}">
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
            class="menu-item  {{ Request::is('clerk/assignclass_staff_edit/*') || Request::is('clerk/assignclass_staff') || Request::is('clerk/classedit/*') || Request::is('clerk/studentpromotion') || Request::is('clerk/sections') || Request::is('clerk/studenttimetable') || Request::is('clerk/studenttimetableedit') || Request::is('clerk/stafftimetable') || Request::is('clerk/stafftimetableedit') ? 'open && active' : '' }}">
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


        <li class="menu-item  {{ Request::is('clerk/transport') || Request::is('transport/add') ? 'active' : '' }}">
            <a href="{{ url('clerk/transport') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-bus'></i>
                <div data-i18n="Analytics">Transport Management</div>
            </a>
        </li>

        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
        <!-- REPORT -->

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
            class="menu-item {{ Request::is('clerk/staffloginlist') || Request::is('clerk/staffloginedit/*') || Request::is('clerk/studentloginlist') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Form Layouts">Role & Premission </div>
            </a>
            <ul class="menu-sub">
                {{-- {{ (strpos(Route::currentRouteName(), 'clerk/staffloginlist') == 0) ? 'active' : '' }} --}}
                <li
                    class="menu-item {{ request()->is('clerk/staffloginedit/*') ? 'active' : '' }} {{ request()->is('clerk/staffloginlist') ? 'active' : '' }}">
                    <a href="{{ url('clerk/staffloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Staff Login</div>
                    </a>

                </li>
                <li class="menu-item {{ 'clerk/studentloginlist' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/studentloginlist') }}" class="menu-link">
                        <div data-i18n="Horizontal Form">Student Login</div>
                    </a>
                </li>
            </ul>
        </li>


        <!-- Exam -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Exam</span></li>
        <!-- Cards -->
        <li
            class="menu-item {{ Request::is('clerk/offlineexam') || Request::is('clerk/offlineexamedit/*') || Request::is('clerk/offlinetimetable') || Request::is('examresult') ? 'open && active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="Form Layouts">Exam</div>
            </a>
            <ul class="menu-sub">
                <li {{-- || 'offlinequarterlyexam'  || 'offlinehalflyexam' || 'offlineannualexam' || 'offlineexamedit' --}}
                    class="menu-item {{ 'clerk/offlineexam' == request()->path() ? 'active' : '' }}{{ 'clerk/offlineexamedit' == request()->path() ? 'active' : '' }} {{ 'clerk/offlinetimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/offlinetimetable') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Exam Timetable</div>
                    </a>
                </li>

            </ul>
        </li>



        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">UTILITIES</span></li>
        <!-- REPORT -->
        <li class="menu-item {{ Request::is('clerk/message') ||  Request::is('clerk/bulkmessage') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Form Layouts">Message</div>
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


        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">REPORT</span></li>
        <!-- REPORT -->
        <li
            class="menu-item  {{ Request::is('clerk/completedstudents') || Request::is('clerk/studentscount') || Request::is('clerk/getClassAttendance') || Request::is('clerk/transferstudents') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Students</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'clerk/completedstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/completedstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">completed </div>
                    </a>
                </li>

                <li class="menu-item {{ 'clerk/transferstudents' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/transferstudents') }}" class="menu-link">
                        <div data-i18n="Without menu">Transfer </div>
                    </a>
                </li>
                <li class="menu-item {{ 'clerk/getClassAttendance' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/getClassAttendance') }}" class="menu-link">
                        <div data-i18n="Without menu">Student Attendance</div>
                    </a>
                </li>
                <li class="menu-item {{ 'clerk/studentscount' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/studentscount') }}" class="menu-link">
                        <div data-i18n="Without menu">Students Count</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item  {{ Request::is('clerk/getvehiclereport') || Request::is('clerk/getstudentreport')  ? 'open && active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Transport</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ 'clerk/getvehiclereport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/getvehiclereport') }}" class="menu-link">
                        <div data-i18n="Without menu">Vehicle Report</div>
                    </a>
                </li>

                <li class="menu-item {{ 'clerk/getstudentreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/getstudentreport') }}" class="menu-link">
                        <div data-i18n="Without menu">Student In Route</div>
                    </a>
                </li>

               
            </ul>
        </li>
        <li class="menu-item {{ Request::is('clerk/feesdetailsreport', 'clerk/getfeesreport', 'clerk/getstudentreport') ? 'open && active' : '' }}">          
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Fees</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{  'clerk/getfeesreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/getfeesreport') }}" class="menu-link">
                        <div data-i18n="Without menu">Fees Report</div>
                    </a>
                </li>
               
               
            </ul>
        </li>
        <li class="menu-item {{ Request::is('clerk/staffsdetailsreport', 'clerk/getstaffreport', 'clerk/getstudentreport') ? 'open && active' : '' }}">            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Extended UI">Staff</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{  'clerk/getstaffreport' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('clerk/getstaffreport') }}" class="menu-link">
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
                {{-- <li class="menu-item {{ 'admin/administrativedetails' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/administrativedetails') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Administrative Details</div>
                    </a>
                </li> --}}

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
                {{-- <li class="menu-item {{ 'admin/time' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('admin/time') }}" class="menu-link">
                        <div data-i18n="Vertical Form">Times</div>
                    </a>
                </li> --}}
            </ul>
        </li>
    </ul>
</aside>
