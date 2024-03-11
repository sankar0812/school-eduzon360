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

        <li class="menu-item  {{ Request::is('classteacher/home') ? 'open && active' : '' }}">
            <a href="{{ url('/classteacher/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">STUDENT</span>
        </li>

        <!-- //student attendance -->
      

        @if (!empty($siderass))
            <li class="menu-item  {{ Request::is('classteacher/studentattendance')|| Request::is('classteacher/studenttakeattendance')|| Request::is('classteacher/monthlycount') ? 'open && active' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-face"></i>

                    <div data-i18n="User interface">Student Management</div>
                </a>


                <ul class="menu-sub">


                    <li class="menu-item {{ 'classteacher/studentattendance' == request()->path() ? 'active' : '' }}">
                        <a href="{{ url('classteacher/studentattendance') }}" class="menu-link">
                            <div data-i18n="Fluid">Student Attendance </div>
                        </a>
                    </li>


                </ul>
            </li>
            <li
                class="menu-item  {{ Request::is('classteacher/studentdetailslist') || Request::is('classteacher/studentdetailsview/*') ? 'open active' : '' }}">
                <a href="{{ url('classteacher/studentdetailslist') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-paste"></i>
                    <div data-i18n="Analytics">Student Details</div>
                </a>
            </li>
        @else
        <li class="menu-item  {{ Request::is('classteacher/studentattendance')|| Request::is('classteacher/studenttakeattendance')|| Request::is('classteacher/monthlycount') ? 'open && active' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-face"></i>

                <div data-i18n="User interface">Student Management</div>
            </a>


            <ul class="menu-sub">


                <li class="menu-item {{ 'classteacher/studentattendance' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/studentattendance') }}" class="menu-link">
                        <div data-i18n="Fluid">Student Attendance </div>
                    </a>
                </li>


            </ul>
        </li>
        <!-- <li
            class="menu-item  {{ Request::is('classteacher/studentdetailslist') || Request::is('classteacher/studentdetailsview/*') ? 'open active' : '' }}">
            <a href="{{ url('classteacher/studentdetailslist') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-paste"></i>
                <div data-i18n="Analytics">Student Details</div>
            </a>
        </li> -->
        @endif
        <li
            class="menu-item {{ Request::is('classteacher/dailycontentview/*') || Request::is('classteacher/dailycontent') || Request::is('classteacher/homework') || Request::is('classteacher/homework/*') ? 'open && active' : '' }}">
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
                <li class="menu-item {{ 'classteacher/dailyhomework' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/dailyhomework') }}" class="menu-link ">
                        <div data-i18n="Without menu">Home Work</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ Request::is('classteacher/dailytimetable') || Request::is('classteacher/studenttimetable') ? 'open && active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">class Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'classteacher/dailytimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/dailytimetable') }}" class="menu-link ">
                        <div data-i18n="Without menu">My Timetable</div>
                    </a>
                </li>
                <li class="menu-item {{ 'classteacher/studenttimetable' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classteacher/studenttimetable') }}" class="menu-link ">
                        <div data-i18n="Without menu">Student Timetable</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Exam -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
        <li class="menu-item   {{ Request::is('classteacher/myattendance') ? 'open && active' : '' }}">
            <a href="{{ url('classteacher/myattendance') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-check"></i>
                <div data-i18n="Analytics">My Attendance</div>
            </a>
        </li>

        <!-- Exam -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Exam</span></li>
        <!-- Cards -->
        <li
            class="menu-item {{ Request::is('classteacher/edit/*') || Request::is('marks/show') || Request::is('classteacher/index') || Request::is('marks/enter') ? 'open && active' : '' }}">
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

        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">UTILITIES</span></li>
        <!-- REPORT -->
        <li class="menu-item   {{ Request::is('classteacher/message') ? 'open && active' : '' }}">
            <a href="{{ url('classteacher/message') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Analytics">Message</div>
            </a>
        </li>


    </ul>
</aside>
