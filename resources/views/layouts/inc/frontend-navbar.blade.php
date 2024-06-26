<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white" aria-label="Navigation Menu" tabindex="0">
    <div class="container">
        <a href="/">
            <img src="{{ asset('assets/images/logo.png') }}" style="width:150px;" class="navbar-brand" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-lg-3 py-3 py-lg-4" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                @php
                    $categories = App\Models\Category::where('status', '0')->get();
                @endphp
                @foreach ($categories as $catitem)
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="{{ url('section/' . $catitem->slug) }}">{{ $catitem->name }}</a>
                    </li>
                @endforeach

                <li class="nav-item dropdown p-3">

                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-label="User menu">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                        @auth
                            <li class="py-1">
                                <span class="opacity-50">{{ Auth::user()->name }}</span>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('user/' . Auth::id()) }}">View Content</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endauth
                        @auth
                            @if (Auth::user()->role_as == '1')
                                <li class="nav-item">
                                    <a class="nav-link mt-3 mx-3 text-white btn btn-info"
                                        href="{{ url('admin/dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                            @if (Auth::user()->role_as == '2')
                                <li class="nav-item">
                                    <a class="nav-link mt-3 mx-3 text-white btn btn-info"
                                        href="{{ url('author/dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                        @endauth
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link mt-3 mx-3 text-white btn btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link mt-3 mx-3 text-white btn btn-warning">Log
                                    in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"
                                        class="nav-link mt-3 mx-3 text-white btn btn-warning">Register</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </li>


                @auth
                    <li class="nav-item dropdown py-3">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" aria-label="Notification Menu" v-pre>
                            <i class="fa fa-bell"></i>
                            <span
                                class="badge badge-light bg-warning badge-xs">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <ul class="dropdown-menu p-3">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <li class="d-flex justify-content-center mx-1 my-2">
                                    <a href="{{ route('mark-as-read') }}" class="btn btn-success text-light btn-sm">Mark
                                        All Read</a>
                                </li>
                            @endif

                            @if (auth()->user()->Notifications->count() > 0)
                                <li class="d-flex justify-content-center mx-1 my-2">
                                    <a href="{{ route('clear-all') }}" class="btn btn-danger btn-sm">Clear All</a>
                                </li>
                            @else
                                <li class="d-flex justify-content-center text-center mx-1 my-2">
                                    <p class="text-secondary">No Notifications</a>
                                </li>
                            @endif

                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <li class="d-flex justify-content-center mx-1 my-2">
                                    <a href="{{ $notification->data['slug'] }}"
                                        class="text-dark fw-bold text-decoration-none">
                                <li class="p-1 text-sm-start"> {{ $notification->data['data'] }}</li></a>
                    </li>
                    @endforeach
                    @foreach (auth()->user()->readNotifications as $notification)
                        <li class="d-flex justify-content-center mx-1 my-2">
                            <a href="{{ $notification->data['slug'] }}" class="text-secondary text-decoration-none">
                        <li class="p-1 text-sm-start text-secondary"> {{ $notification->data['data'] }}</li></a>
                        </li>
                    @endforeach

                @endauth


            </ul>
        </div>
    </div>
</nav>
