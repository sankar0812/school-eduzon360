<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme Side__theme">
    <div class="app-brand demo">
        <a href="{{ url('student/studenthome') }}" class="">
            <span class="app-brand-text  demo menu-text fw-bolder ms-2">School Management</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    {{-- <div class="menu-inner-shadow"></div> --}}
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  {{ Request::is('student/studenthome') ? 'open' : '' }}">
            <a href="{{ url('student/studenthome') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
            </a>
        </li>
       
       
          {{-- <li class="menu-item  {{ Request::is('student/subject') || Request::is('student/dailytopic') ? 'open' : '' }}">
            <a href="{{ url('student/subject') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-paste"></i>
                <div data-i18n="Analytics">DailyTopic</div>
            </a>
        </li> --}}
        <li
        class="menu-item   {{ Request::is('student/homework') || Request::is('student/dailytopic') ? 'open' : '' }} ">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-customize"></i>
            <div data-i18n="User interface">Study Material</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ 'student/dailytopic' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('student/dailytopic') }}" class="menu-link ">
                    <div data-i18n="Without menu">Daily Topic</div>
                </a>
            </li>
            <li class="menu-item {{ 'student/homework' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('student/homework') }}" class="menu-link">
                    <div data-i18n="Without navbar">Home Work</div>
                </a>
            </li>
        </ul>
    </li>
        <li
            class="menu-item   {{ (Request::is('student/examschedule') ? 'open' : '' || Request::is('student/exammark')) ? 'open' : '' }} ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pen"></i>
                <div data-i18n="User interface">Exam Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ 'student/examschedule' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('student/examschedule') }}" class="menu-link ">
                        <div data-i18n="Without menu">Exam Timetable</div>
                    </a>
                </li>
                <li class="menu-item {{ 'student/exammark' == request()->path() ? 'active' : '' }}">
                    <a href="{{ url('student/exammark') }}" class="menu-link">
                        <div data-i18n="Without navbar">Exam Result</div>
                    </a>
                </li>
            </ul>
        </li>
     
        <li class="menu-item  {{ Request::is('student/feesdetails') ? 'open' : '' }}">
            <a href="{{ url('student/feesdetails') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Analytics">Fee details</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('student/classtimetable') ? 'open' : '' }}">
            <a href="{{ url('student/classtimetable') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div data-i18n="Analytics">Class Timetable</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('student/staff') ? 'open' : '' }}">
            <a href="{{ url('student/staff') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Analytics">Staffs</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('student/studentattendance') ? 'open' : '' }}">
            <a href="{{ url('student/studentattendance') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Analytics">My Attendance</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('student/messages') ? 'open' : '' }}">
            <a href="{{ url('student/messages') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div data-i18n="Analytics">Message</div>
            </a>
        </li>
        <!-- Misc -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li> --}}
        <li class="menu-item">
            @if (session()->has('studentid'))
                <a href="{{ route('student.logout') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-power-off"></i>
                    <div data-i18n="Support">{{ __('Logout') }}</div>
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
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
    </ul>
</aside>