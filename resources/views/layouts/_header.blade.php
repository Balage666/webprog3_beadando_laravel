<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand ms-0 ms-lg-5" href="/"> <i class="fa-brands fa-laravel"></i> {{ env('BRAND') }}</a>

        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#plsCollapse"
                aria-controls="plsCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="plsCollapse">

            <div class="navbar-nav">
                <a class="nav-item nav-link btn btn-secondary {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home <i class="fa-solid fa-store"></i> </a>

                @auth
                    @if (Auth::User()->role == 'admin')

                        <a class="nav-item nav-link btn btn-secondary {{ Request::is('gardentool/create') ? 'active' : '' }}" href="{{ url('/gardentool/create') }}">Create new Gardening Tool <i class="fa-solid fa-square-plus"></i> </a>

                    @endif
                @endauth

                @if ( Request::is('/*') )

                    <form action="{{ url('/') }}" method="GET" class="mx-2 my-auto d-inline w-90">
                        <div class="input-group">
                            <input type="search" name="searchInput" value="{{ request()->input('searchInput') }}" class="form-control border border-end-0" placeholder="Search...">
                            <button type="submit" class="btn btn-secondary border border-5 border-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                @elseif (Request::is('admin'))

                    <form action="{{ url('/admin') }}" method="GET" class="mx-2 my-auto d-inline w-90">
                        <div class="input-group">
                            <input type="search" name="searchInput" value="{{ request()->input('searchInput') }}" class="form-control border border-end-0" placeholder="Search...">
                            <button type="submit" class="btn btn-secondary border border-5 border-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                @endif

            </div>

            <div class="navbar-nav ms-auto">

                <a class="nav-item nav-link btn btn-secondary {{ Request::is('cart/view') ? 'active' : '' }}" href="{{ url('/cart/view') }}"> <span class="badge bg-success">{{ Session::has('cart') ? Session::get('cart')->totalQuantity : '' }}</span> Shopping Cart <i class="fa-solid fa-shopping-cart"></i> </a>

                @if ( Request::is('/'))

                    @auth
                        <a class="nav-item nav-link btn btn-secondary" href="#">Order History <i class="fa-solid fa-gifts"></i> </a>
                    @endauth

                @endif

                <div class="dropstart">
                    <a
                        class="nav-link btn btn-secondary dropdown-toggle me-0 me-lg-5"
                        href="#"
                        id="navbarDropdownMenuLink"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        User Menu <i class="fa-solid fa-user"></i>
                    </a>
                    <div class="dropdown-menu bg-secondary me-0" aria-labelledby="navbarDropdownMenuLink">

                        @if (Auth::User())
                            <a class="dropdown-item btn btn-secondary">{{ Auth::User()->first_name.' '.Auth::User()->last_name }}<i class="fa-solid fa-person"></i> </a>

                            @if (Auth::User()->role == 'admin')
                                <a class="dropdown-item btn btn-secondary {{ Request::is('admin') ? 'active' : '' }} " href="{{ url('/admin') }}">Product Management <i class="fa-solid fa-toolbox"></i> </a>
                            @endif

                            <hr class="dropdown-divider">
                            <a class="dropdown-item btn btn-secondary" href="{{ url('/sign-out') }}">Sign Out <i class="fa-solid fa-right-from-bracket"></i> </a>

                        @else
                            <a class="dropdown-item btn btn-secondary {{ Request::is('sign-in') ? 'active' : '' }}" href="{{ url('/sign-in') }}">Sign In <i class="fa-solid fa-right-to-bracket"></i> </a>
                            <a class="dropdown-item btn btn-secondary {{ Request::is('sign-up') ? 'active' : '' }}" href="{{ url('/sign-up') }}">Sign Up <i class="fa-solid fa-arrow-up-from-bracket"></i> </a>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </nav>
</header>
