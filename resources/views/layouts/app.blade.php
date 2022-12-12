<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

        body {
            background: linear-gradient(90deg, rgb(147, 15, 255) 2%, rgb(5, 49, 255) 100.7%);
            font-family: 'Source Sans Pro', sans-serif;
        }

        .alert-fixed {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            z-index: 9999;
            border-radius: 0px
        }

        .nav_title {
            display: none;
        }

        @media (max-width: 991px) {
            .xd {
                margin-bottom: 5px;
            }

            .post_card {
                text-align: left;
            }

            img {
                max-width: 100%;
            }

            .login {
                margin-top: 5px;
            }
        }

        @media (min-width: 991px) {
            .nav-footer {
                display: none;
            }

            .post_card {
                text-align: center;
            }
        }

        footer {
            opacity: 70%;
        }

        .card_header {
            text-decoration: none;
        }
    </style>

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
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        });
    </script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
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
                    <li class="nav-item me-2">
                        <a class="nav-link" data-bs-target="#searchModal" data-bs-toggle="modal" href="#"><i
                                class="fa-solid fa-search me-1 my-auto"></i>Hledat</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle me-1"
                                    style="width: 30px; height: 30px;">
                                {{ Auth::user()->name }}
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
                <hr class="divider">
                <div class="nav-footer mb-2">
                    © 2022 Filip Vaněk
                </div>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Hledat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" value="{{ old('search') }}"
                                placeholder="Hledejte příspěvky, uživatele, subfora" aria-label="Hledat"
                                aria-describedby="button-addon2" aria-required="true" required>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                    class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
