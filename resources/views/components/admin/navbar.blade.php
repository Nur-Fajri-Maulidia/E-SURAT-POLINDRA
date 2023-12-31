<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="javascript:void(0)"><img
                src="{{ asset('assets/images/polindra.png') }}" class="mr-2" alt="logo" />E-Surat</a>
        <a class="navbar-brand brand-logo-mini" href="javascript:void(0)"><img
                src="{{ asset('assets/images/polindra.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{ auth()->user()->avatar() }}" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    @can('Profile Edit')
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="ti-user text-primary"></i>
                            Edit Profile
                        </a>
                    @endcan
                    <form method="post" action="{{ route('signout') }}">
                        @csrf
                        <a href="{{ route('signout') }}" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </form>
                    {{-- <form action="{{ route('logout') }}" id="formLogout" method="post">
                        @csrf
                        <a class="dropdown-item" onclick="document.getElementById('formLogout').submit()">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>

                    </form> --}}
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
