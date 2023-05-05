<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white">
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
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
                @php
                    $categories = App\Models\Category::where('navbar_status', '0')->where('status', '0')->get();
                @endphp
                @foreach ($categories as $catitem)
                <li class="nav-item">
                    <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('section/'.$catitem->slug) }}">{{ $catitem->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
