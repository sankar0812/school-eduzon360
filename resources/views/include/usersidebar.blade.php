<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('/home') }}" class="">
            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    {{-- <div class="menu-inner-shadow"></div> --}}

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('home') ? 'open' : '' }}">
            <a href="{{ url('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-item  {{ Request::is('dashboard') ? 'open' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Analytics">Student MarkEntry</div>
            </a>
        </li>

        <li
            class="menu-item   {{ Request::is('filterattendance') || Request::is('takeattendance') || Request::is('addstaff') || Request::is('staffdetails') || Request::is('staffsalary') || Request::is('staffattendance') || Request::is('staffedit') || Request::is('staffsalaryedit') || Request::is('staffview') || Request::is('staffsalaryview') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Account Settings">Timetable Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'addstaff' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('addstaff') }}" class="menu-link">
                        <div data-i18n="Container">Staff Timetable</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item  {{ Request::is('class_section') || Request::is('classtimetable') || Request::is('timetableedit') ? 'open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="User interface">Message-Service Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'class_section' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('class_section') }}" class="menu-link ">
                        <div data-i18n="Without menu">Message to Admin</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'classtimetable' == request()->path() ? 'active' : '' }} {{ 'timetableedit' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('classtimetable') }}" class="menu-link">
                        <div data-i18n="Without navbar">Message to Staff</div>
                    </a>
                </li>
                <li class="menu-item {{ 'studentattendance' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('studentattendance') }}" class="menu-link">
                        <div data-i18n="Accordion">Message to Student</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item  {{ Request::is('dashboard') ? 'open' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-paste"></i>
                <div data-i18n="Analytics">Daily Teaching Content</div>
            </a>
        </li>
        <li
            class="menu-item   {{ Request::is('filterattendance') || Request::is('takeattendance') || Request::is('addstaff') || Request::is('staffdetails') || Request::is('staffsalary') || Request::is('staffattendance') || Request::is('staffedit') || Request::is('staffsalaryedit') || Request::is('staffview') || Request::is('staffsalaryview') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-book"></i>
                <div data-i18n="Account Settings">Report Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'addstaff' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('addstaff') }}" class="menu-link">
                        <div data-i18n="Container">Student</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ 'staffdetails' == request()->path() ? 'active' : '' }} {{ 'staffedit' == request()->path() ? 'active' : '' }} {{ 'staffview' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('staffdetails') }}" class="menu-link">
                        <div data-i18n="Account">Staff</div>
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
