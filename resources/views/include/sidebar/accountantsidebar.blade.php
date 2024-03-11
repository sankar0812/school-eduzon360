<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/accountant/home') }}" class="app-brand-link">
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
        <li class="menu-item  {{ Request::is('accountant/home') ? 'open' : '' }}">
            <a href="{{ url('accountant/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li
            class="menu-item  {{ Request::is('accountant/school_info') || Request::is('accountant/administrativeedit/{id}') ? 'open' : '' }}">
            <a href="{{ url('accountant/school_info') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">School Information</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">STUDENT</span>
        </li>

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
                {{-- <li
                    class="menu-item {{ 'accountant/dailyfees' == request()->path() ? 'active' : '' }} {{ 'accountant/monthlyfees' == request()->path() ? 'active' : '' }}  {{ 'accountant/yearlyfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('accountant/dailyfees') }}" class="menu-link">
                        <div data-i18n="Input groups">Fees Details</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ 'accountant/paidfees' == request()->path() ? 'active' : '' }} ">
                    <a href="{{ url('accountant/paidfees') }}" class="menu-link">
                        <div data-i18n="Input groups">student paid details</div>
                    </a>
                </li>
            </ul>
        </li>


        <!-- REPORT -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HR</span></li>
        <!-- REPORT -->



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
     
    </ul>
</aside>
