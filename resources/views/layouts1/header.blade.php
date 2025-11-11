 <!--<header data-aos="fade-down bg1" id="slider">-->
<header data-aos="fade-down" >           
        <nav>
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-md-2 col-2">
                        <a href="/">
                            <img src="{{ asset('assets/images/logo.png') }}" class="logo1" />
                        </a>
                    </div>

                     
                    <div class="col-sm-2 col-2">
                    <div class="dropdown" style="text-align: left; position: relative;">
                        <button class="custom-button1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Explore</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach($service_types as $service)
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="handleServiceSelect('{{ $service->name }}')">
                                        {{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                    
                    <div class="col-sm-8 col-8 text-end">
                            @auth
                            <div class="dropdown">
                                {{-- <a class="dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none !important; color:black"> --}}
                                    @if(auth()->user()->userInformation)

                                        <img id="user-avatar" class="user-avatar rounded-circle" src="{{ asset('storage/' . auth()->user()->userInformation->logo) }}" class="user-profile-img" style="width:40px">
                                    @else
                                        <img id="user-avatar" class="user-avatar rounded-circle" src="{{ asset('assets/images/sign-in/profile.png') }}" alt="User Profile Image" class="user-profile-img" style="width:40px">
                                    @endif
                                    <button class="custom-button1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>{{ auth()->user()->name }}</span>
                                    </button>

                                {{-- </a> --}}
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @if(auth()->user()->hasRole('admin'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                            </li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                    @elseif(auth()->user()->hasRole('company'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('company.profile') }}">Profile</a>
                                        </li>
                                        <a class="dropdown-item" href="{{ route('company.dashboard') }}">Company Dashboard</a>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.dashboard') }}">Customer Dashboard</a>
                                    </li>

                                     <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    @endif

                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @else
                            <button class="custom-button1">
                                <a href="{{ route('login') }}"><span>Login</span></a>
                            </button>
                            <button class="custom-button1 join-as-btn">
                                <a href="{{ route('register') }}"><span>Join As A Professional</span></a>
                            </button>
                            @endauth

                        {{-- <button class="custom-button1">
                            <a href="{{ route('employees.create') }}"><span>Employee Register</span></a>
                        </button> --}}

                    </div>
                </div>
            </div>
        </nav>
    
        
    </header>