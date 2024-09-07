<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">

    <!-- Scripts -->
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    @vite(["resources/sass/app.scss", "resources/js/app.js"])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100 bglight">
        <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm fftitle p-0">
            <div class="container">
                <a class="navbar-brand coprimary fw-bolder" href="{{ url("/") }}">
                    JobBoard
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav  ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link coprimary fw-semibold" href="{{ url("/") }}">Home</a>
                        </li>
                        @guest
                            @if (Route::has("login"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("login") }}">{{ __("Login") }}</a>
                                </li>
                            @endif

                            @if (Route::has("register"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("register") }}">{{ __("Register") }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route("logout") }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __("Logout") }}
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class=" bg-success justify-content-center align-content-center px-4 py-3">
                    <a href="/" class="link m-auto fw-semibold link-underline-opacity-0 link-light colightopacity">Post a
                        Job &#8594;</a>
                </div>
            </div>
        </nav>

        <main class="container bgwhite flex-grow-1">
            @yield("content")
        </main>

        <footer class="container bgdark colight py-4">
            <div class="row pt-5 colightopacity">
                <div class="col">
                    <ul style="list-style-type:none;" class="">
                        <li>
                            <h5 class="fw-bold colight">Company</h5>
                        </li>

                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0  link-light link-opacity-50">Home</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">About
                                Us</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Contact
                                Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul style="list-style-type:none;" class="">
                        <li>
                            <h5 class="fw-bold colight">Company</h5>
                        </li>

                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Home</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">About
                                Us</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Contact
                                Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul style="list-style-type:none;" class="">
                        <li>
                            <h5 class="fw-bold colight">Company</h5>
                        </li>

                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Home</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">About
                                Us</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Contact
                                Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul style="list-style-type:none;" class="">
                        <li>
                            <h5 class="fw-bold colight">Company</h5>
                        </li>

                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Home</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">About
                                Us</a>
                        </li>
                        <li>
                            &#10148; <a href="/" class="link-underline-opacity-0 link-light link-opacity-50 ">Contact
                                Us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div>
                <div>
                    <span class="colightopacity"> &#169; </span> Your Site Name <span class="colightopacity"> All Rights Reserved </span>
                </div>
                <div></div>
            </div>
        </footer>
    </div>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "timeOut": "3000"
        };

        @if (session("success"))
            toastr.success("{{ session("success") }}");
        @endif

        @if (session("error"))
            toastr.error("{{ session("error") }}");
        @endif
    </script>
</body>

</html>
