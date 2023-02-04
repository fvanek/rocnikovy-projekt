<nav class="navbar navbar-expand-lg bg-light sticky-top rounded mt-2 mx-2 shadow">
    <div class="container-fluid">
        <span class="navbar-brand">{{ config('app.name') }}</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="col-12 col-lg-7 mx-lg-auto">
                <livewire:searchbar />
            </div>
            <ul class="navbar-nav d-flex ms-auto">
                <hr class="divider">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle me-1"
                                style="width: 30px; height: 30px;" alt="Avatar">
                            {{ Auth::user()->name }}
                            @if (Auth::user()->is_admin == 1)
                                <span class="badge bg-danger ms-1">admin</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}"><i
                                        class="fa-solid fa-user me-1"></i>Můj
                                    profil</a>
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
                            @if (Auth::user()->is_admin == 1)
                                <li>
                                    <a href="{{ route('admin/dashboard') }}" class="dropdown-item">
                                        <i class="fa-solid fa-bolt me-1"></i>Admin dashboard
                                    </a>
                                </li>
                            @endif
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
                        <a class="nav-link btn btn-primary rounded-pill text-white login" href="{{ route('login') }}"><i
                                class="fas fa-sign-in-alt me-1"></i>Přihlásit
                            se</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
