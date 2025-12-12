<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/images/logo.png') }}" class="logo1" style="width:100%;" />
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        @can('dashboard')
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="/admin/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        @endcan
                @can('locations-list')
                <li class="menu-item {{ request()->is('location*') ? 'active' : '' }}">
                    <a href="{{ route('location.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-map"></i>
                        <div data-i18n="Locations">Locations</div>
                    </a>
                </li>
                @endcan
        <!-- Website Content -->
        @php
            $contentPermissions = ['abouts-list', 'whychoose-list', 'teams-list', 'testimonials-list', 'blogs-list', 'processes-list', 'popup-list'];
        @endphp
        @if(array_filter($contentPermissions, fn($perm) => auth()->user()->can($perm)))
        <li class="menu-item {{ request()->is('abouts*','why-chooses*','teams*','testimonials*','blogs*','processes*','popup*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Website Content">Website Content</div>
            </a>
            <ul class="menu-sub">
                @can('abouts-list')
                <li class="menu-item {{ request()->is('abouts*') ? 'active' : '' }}">
                    <a href="{{ route('abouts.index') }}" class="menu-link"><div data-i18n="About Section">About Section</div></a>
                </li>
                @endcan
                @can('whychoose-list')
                <li class="menu-item {{ request()->is('why-chooses*') ? 'active' : '' }}">
                    <a href="{{ route('why-chooses.index') }}" class="menu-link"><div data-i18n="Why Choose Us">Why Choose Us</div></a>
                </li>
                @endcan
                @can('teams-list')
                <li class="menu-item {{ request()->is('teams*') ? 'active' : '' }}">
                    <a href="{{ route('teams.index') }}" class="menu-link"><div data-i18n="Teams">Team Members</div></a>
                </li>
                @endcan
                @can('testimonials-list')
                <li class="menu-item {{ request()->is('testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('testimonials.index') }}" class="menu-link"><div data-i18n="Testimonials">Testimonials</div></a>
                </li>
                @endcan
                @can('blogs-list')
                <li class="menu-item {{ request()->is('blogs*') ? 'active' : '' }}">
                    <a href="{{ route('blogs.index') }}" class="menu-link"><div data-i18n="Blogs">Blogs</div></a>
                </li>
                @endcan
                <!-- @can('processes-list') -->
                <li class="menu-item {{ request()->is('processes*') ? 'active' : '' }}">
                    <a href="{{ route('processes.index') }}" class="menu-link"><div data-i18n="Process Steps">Process Steps</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('popup-list') -->
                <li class="menu-item {{ request()->is('popup*') ? 'active' : '' }}">
                    <a href="{{ route('popup.index') }}" class="menu-link"><div data-i18n="Popup Section">Popup Section</div></a>
                </li>
                <!-- @endcan -->
            </ul>
        </li>
        @endif

        <!-- Products & Services -->
        <li class="menu-item {{ request()->is('categories*','products*','services*','package*','lead-services*','sliders*','companies*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Products & Services">Products & Services</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('categories*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="menu-link"><div data-i18n="Categories">Categories</div></a>
                </li>
                <li class="menu-item {{ request()->is('products*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="menu-link"><div data-i18n="Products">Products</div></a>
                </li>
                <!-- @can('service-list') -->
                <li class="menu-item {{ request()->is('services*') ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}" class="menu-link"><div data-i18n="Service">Service</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('service-type-list') -->
                <li class="menu-item {{ request()->is('lead-services*') ? 'active' : '' }}">
                    <a href="{{ route('lead-services.index') }}" class="menu-link"><div data-i18n="Service Type">Service Type</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('package-list') -->
                <li class="menu-item {{ request()->is('package*') ? 'active' : '' }}">
                    <a href="{{ route('package.index') }}" class="menu-link"><div data-i18n="Package">Package</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('sliders-list') -->
                <li class="menu-item {{ request()->is('sliders*') ? 'active' : '' }}">
                    <a href="{{ route('sliders.index') }}" class="menu-link"><div data-i18n="Sliders">Sliders</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('company-list') -->
                <li class="menu-item {{ request()->is('companies*') ? 'active' : '' }}">
                    <a href="{{ route('companies.index') }}" class="menu-link"><div data-i18n="Companies">Companies</div></a>
                </li>
                <!-- @endcan -->
                 
            </ul>
        </li>

        <!-- Users & Roles -->
        <li class="menu-item {{ request()->is('users*','roles*','permission*','employees*','sellers*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Users & Roles">Users & Roles</div>
            </a>
            <ul class="menu-sub">
                @can('user-list')
                <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link"><div data-i18n="Users">Users</div></a>
                </li>
                @endcan
                @can('role-list')
                <li class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="menu-link"><div data-i18n="Roles">Roles</div></a>
                </li>
                @endcan
                @can('permission-list')
                <li class="menu-item {{ request()->is('permission*') ? 'active' : '' }}">
                    <a href="{{ route('permission.index') }}" class="menu-link"><div data-i18n="Permissions">Permissions</div></a>
                </li>
                @endcan
                @can('employees-list')
                <li class="menu-item {{ request()->is('employees*') ? 'active' : '' }}">
                    <a href="{{ route('employees.index') }}" class="menu-link"><div data-i18n="Employees">Employees</div></a>
                </li>
                @endcan
            </ul>
        </li>

        <!-- Leads & Messaging -->
        @canany(['leads-list','messages-list','newsletters-list','prayer-requests-list'])
        <li class="menu-item {{ request()->is('leads*','messages*','newsletters*','prayer_requests*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Leads & Messages">Leads & Messages</div>
            </a>
            <ul class="menu-sub">
                <!-- @can('leads-list') -->
                <li class="menu-item {{ request()->is('leads*') ? 'active' : '' }}">
                    <a href="{{ route('leads.index') }}" class="menu-link"><div data-i18n="Leads">Leads</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('messages-list') -->
                <li class="menu-item {{ request()->is('messages*') ? 'active' : '' }}">
                    <a href="{{ route('messages.index') }}" class="menu-link"><div data-i18n="Messages">Messaging System</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('newsletters-list') -->
                <li class="menu-item {{ request()->is('newsletters*') ? 'active' : '' }}">
                    <a href="{{ route('newsletters.index') }}" class="menu-link"><div data-i18n="Newsletters">Newsletters</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('prayer-requests-list') -->
                <li class="menu-item {{ request()->is('prayer_requests*') ? 'active' : '' }}">
                    <a href="{{ route('prayer_requests.index') }}" class="menu-link"><div data-i18n="Prayer Requests">Prayer Requests</div></a>
                </li>
                <!-- @endcan -->
            </ul>
        </li>
        @endcanany

        <!-- Settings -->
        @canany(['general_setting','account-setting'])
        <li class="menu-item {{ request()->is('general_setting*','profile*','change_password*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
                <!-- @can('general_setting') -->
                <li class="menu-item {{ request()->is('general_setting*') ? 'active' : '' }}">
                    <a href="{{ route('general_setting.index') }}" class="menu-link"><div data-i18n="General Setting">General Setting</div></a>
                </li>
                <!-- @endcan -->
                <!-- @can('account-setting') -->
                <li class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class="menu-link"><div data-i18n="Profile">Profile</div></a>
                </li>
                <li class="menu-item {{ request()->is('change_password*') ? 'active' : '' }}">
                    <a href="{{ route('change_password') }}" class="menu-link"><div data-i18n="Change Password">Change Password</div></a>
                </li>
                <!-- @endcan -->
            </ul>
        </li>
        @endcanany

        <!-- Logout -->
        <li class="menu-item">
            <a href="{{ url('/logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>
    </ul>
</aside>
<!-- /Menu -->

