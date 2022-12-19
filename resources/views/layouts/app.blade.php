<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/f733c57976.js" crossorigin="anonymous"></script>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/atv0zz5w87uf8ihnq71cwdpdyaknsvib3auq25226a3dha1y/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            language: 'cs',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace',
                'fullscreen', 'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'backcolor | bold italic underline | h1 h2 h3 | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        });
    </script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg bg-light sticky-top rounded mt-2 mx-2 shadow-lg">
        <div class="container-fluid">
            <span class="navbar-brand">{{ $nav_title }}</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i>Domů</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subforums') }}"><i
                                class="fa-solid fa-comments me-1"></i>Subfora</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex ms-auto">
                    <li class="nav-item me-2 my-auto">
                        <div class="collapse collapse-horizontal" id="searchCollapse">
                            <form action="{{ route('search') }}" method="GET" class="d-flex">
                                <input class="form-control me-2" type="search" name="search" placeholder="Hledat"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Hledat</button>
                            </form>
                        </div>
                    <li>
                    <li class="nav-item me-2 my-auto">
                        <a class="nav-link" data-bs-target="#searchCollapse" data-bs-toggle="collapse" href="#"><i
                                class="fa-solid fa-search me-1"></i>Hledat</a>
                    </li>

                    <hr class="divider">
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle me-1"
                                    style="width: 30px; height: 30px;">
                                {{ Auth::user()->name }}
                                @if (Auth::user()->is_admin == 1)
                                    <span class="badge bg-danger ms-1">(admin)</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}"><i
                                            class="fa-solid fa-user me-1"></i>Můj
                                        profil</a>
                                    </a>
                                </li>
                                <li><a href="{{ route('posts/mine') }}" class="dropdown-item"><i
                                            class="fa-solid fa-user-pen me-1"></i>Moje
                                        příspěvky</a>
                                <li>
                                <li><a href="{{ route('posts/favorites') }}" class="dropdown-item"><i
                                            class="fa-solid fa-heart me-1"></i>Oblíbené
                                        příspěvky</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-right-from-bracket me-1"></i>Odhlásit se
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary rounded-pill text-white login"
                                href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Přihlásit
                                se</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer>
        <div class="d-flex justify-content-between py-3 bg-white fixed-bottom rounded mb-2 mx-2 shadow-lg">
            <div class="align-items-center ms-4">
                <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Filip Vaněk</span>
            </div>

            <ul class="nav justify-content-end list-unstyled">
                <li class="ms-3"><a class="text-muted" href="https://twitter.com/skeroparno" target="_blank"><i
                            class="fa-brands fa-twitter"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="https://www.instagram.com/_filip.vanek_/"
                        target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li class="ms-3 me-3"><a class="text-muted" href="https://www.facebook.com/skeroparno"
                        target="_blank"><i class="fa-brands fa-facebook"></i>
                    </a></li>
            </ul>
        </div>
    </footer>
    <script>
        window.addEventListener("scroll", function() {
            if (window.scrollY + 20 >= document.body.offsetHeight - window.innerHeight) {
                document.querySelector('footer').style.opacity = '0';
            } else {
                document.querySelector('footer').style.opacity = '1';
            }
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
