<!-- Menu -->
 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                   <img src="{{ asset('assets/images/logo.png') }}" class="logo1" style="width:100%;"/>
            </span>
            {{-- <span class="demo menu-text fw-bolder ms-2" style="font-size:30px">Quick Solutions</span> --}}
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
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @endcan
        <li class="menu-item {{ request()->is('categories*') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="categories">categories</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('products*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="products">products</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('popup*') ? 'active' : '' }}">
            <a href="{{ route('popup.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="About">Popup Section</div>
            </a>
        </li>
        <!-- Website Sections -->
        @can('about-list')
        <li class="menu-item {{ request()->is('abouts*') ? 'active' : '' }}">
            <a href="{{ route('abouts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="About">About Section</div>
            </a>
        </li>
        @endcan

        @can('whychoose-list')
        <li class="menu-item {{ request()->is('why-chooses*') ? 'active' : '' }}">
            <a href="{{ route('why-chooses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div data-i18n="Why Choose Us">Why Choose Us</div>
            </a>
        </li>
        @endcan

        @can('teams-list')
        <li class="menu-item {{ request()->is('teams*') ? 'active' : '' }}">
            <a href="{{ route('teams.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Teams">Team Members</div>
            </a>
        </li>
        @endcan

        @can('testimonials-list')
        <li class="menu-item {{ request()->is('testimonials*') ? 'active' : '' }}">
            <a href="{{ route('testimonials.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-rounded-dots"></i>
                <div data-i18n="Testimonials">Testimonials</div>
            </a>
        </li>
        @endcan

        @can('blogs-list')
        <li class="menu-item {{ request()->is('blogs*') ? 'active' : '' }}">
            <a href="{{ route('blogs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Blogs">Blogs</div>
            </a>
        </li>
        @endcan

        @can('processes-list')
        <li class="menu-item {{ request()->is('processes*') ? 'active' : '' }}">
            <a href="{{ route('processes.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-git-branch"></i>
                <div data-i18n="Process Steps">Process Steps</div>
            </a>
        </li>
        @endcan


        <!-- Location -->
        @can('locations-list')
        <li class="menu-item {{ request()->is('location.index') ? 'active' : '' }}">
            <a href="{{ route('location.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Analytics">Locations</div>
            </a>
        </li>
        @endcan


        <!-- Slider -->
        @can('sliders-list')
        <li class="menu-item {{ request()->is('sliders.index') ? 'active' : '' }}">
            <a href="{{route('sliders.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-carousel"></i>
                <div data-i18n="Analytics">Sliders</div>
            </a>
        </li>
        @endcan


        <!-- Service Type -->
        @can('service-type-list')
        <li class="menu-item {{ request()->is('package.index') ? 'active' : '' }}">
            <a href="{{route('lead-services.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Analytics">Service Type</div>
            </a>
        </li>
        @endcan


        <!-- Service -->
        @can('service-list')
        <li class="menu-item {{ request()->is('services.index') ? 'active' : '' }}">
            <a href="{{route('services.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Analytics">Service</div>
            </a>
        </li>
        @endcan


        <!-- Package -->
        @can('package-list')
        <li class="menu-item {{ request()->is('package.index') ? 'active' : '' }}">
            <a href="{{route('package.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Analytics">Package</div>
            </a>
        </li>
        @endcan


        <!-- Company -->
        @can('company-list')
        <li class="menu-item {{ request()->is('companies.index') ? 'active' : '' }}">
            <a href="{{route('companies.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building"></i>
                <div data-i18n="Analytics">Company</div>
            </a>
        </li>
        @endcan


        <!-- Leads -->
        @can('leads-list')
        <li class="menu-item {{ request()->is('leads.index') ? 'active' : '' }}">
            <a href="{{route('leads.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Leads</div>
            </a>
        </li>
        @endcan


        <!-- Employees -->
        @can('employees-list')
        <li class="menu-item {{ request()->is('employees.index') ? 'active' : '' }}">
            <a href="{{route('employees.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Employees</div>
            </a>
        </li>
        @endcan


        <!-- Manage Roles -->
        @can('role-list')
        <li class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shield"></i>
                <div data-i18n="Layouts">Manage Roles</div>
            </a>
            <ul class="menu-sub">
                @can('role-list')
                <li class="menu-item {{ request()->is('roles') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <div data-i18n="Without menu">List Role</div>
                    </a>
                </li>
                @endcan
                @can('role-create')
                <li class="menu-item {{ request()->is('roles/create') ? 'active' : '' }}">
                    <a href="{{ route('roles.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Create Role</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        <!-- Manage Users -->
        @can('user-list')
        <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Layouts">Manage Users</div>
            </a>
            <ul class="menu-sub">
                @can('user-list')
                <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div data-i18n="Without menu">User List</div>
                    </a>
                </li>
                @endcan
                @can('user-create')
                <li class="menu-item {{ request()->is('users/create') ? 'active' : '' }}">
                    <a href="{{ route('users.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Add User</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        <!-- Announcements -->
        @can('announcements-list')
        <li class="menu-item {{ request()->is('announcements') ? 'active' : '' }}">
            <a href="{{ route('announcements.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bullhorn"></i>
                <div data-i18n="Analytics">Announcements</div>
            </a>
        </li>
        @endcan

        <!-- Messaging System -->
        @can('messages-list')
        <li class="menu-item {{ request()->is('messages') ? 'active' : '' }}">
            <a href="{{ route('messages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-square-detail"></i>
                <div data-i18n="Analytics">Messaging System</div>
            </a>
        </li>
        @endcan

        <!-- Newsletters -->
        @can('newsletters-list')
        <li class="menu-item {{ request()->is('newsletters') ? 'active' : '' }}">
            <a href="{{ route('newsletters.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">Newsletters</div>
            </a>
        </li>
        @endcan

        <!-- Prayer Requests -->
        @can('prayer-requests-list')
        <li class="menu-item {{ request()->is('prayer_requests') ? 'active' : '' }}">
            <a href="{{ route('prayer_requests.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-pray"></i>
                <div data-i18n="Analytics">Prayer Requests</div>
            </a>
        </li>
        @endcan

        <!-- Manage Permissions -->
        @can('permission-list')
        <li class="menu-item {{ request()->is('permission*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Layouts">Manage Permissions</div>
            </a>
            <ul class="menu-sub">
                @can('permission-list')
                <li class="menu-item {{ request()->is('permission') ? 'active' : '' }}">
                    <a href="{{ route('permission.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Permission List</div>
                    </a>
                </li>
                @endcan
                @can('permission-create')
                <li class="menu-item {{ request()->is('permission/create') ? 'active' : '' }}">
                    <a href="{{ route('permission.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Add Permission</div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        <!-- General Setting -->
        @can('general_setting')
        <li class="menu-item {{ request()->is('general_setting*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Layouts">Manage General Setting</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('general_setting') ? 'active' : '' }}">
                    <a href="{{ route('general_setting.index') }}" class="menu-link">
                        <div data-i18n="Without menu">General Setting</div>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        <!-- Account Setting -->
        @can('account-setting')
        <li class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Layouts">Account Setting</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Profile</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('change_password') ? 'active' : '' }}">
                    <a href="{{ route('change_password') }}" class="menu-link">
                        <div data-i18n="Without navbar">Change Password</div>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        <!-- Logout -->
        <li class="menu-item">
            <a href="{{ url('/logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Analytics">Logout</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
