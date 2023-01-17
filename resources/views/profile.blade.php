<x-layout>
    @auth
        @if (Auth::user()->id == $user->id || Auth::user()->is_admin == 1)
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="card-title text-center">{{ auth()->user()->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                            alt="Profile Picture">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>{{ auth()->user()->bio }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>{{ auth()->user()->email }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>Počet příspěvků: {{ auth()->user()->posts->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>Členem od {{ date('d.m.Y', strtotime(auth()->user()->created_at)) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 profile_settings">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="card-title text-center">Nastavení</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('profile/update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Profilová fotka</label>
                                            <input class="form-control" type="file" id="avatar" name="avatar">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jméno</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Napište něco o sobě...">{{ auth()->user()->bio }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3"><i
                                                class="fa-solid fa-cloud-arrow-up me-2"></i>Uložit</button>
                                    </form>
                                </div>
                                <hr class="divider">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        <i class="fa-solid fa-trash me-2"></i>Smazat účet
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->id == $user->id && Auth::user()->is_admin == 0)
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h5 class="card-title text-center">{{ $user->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $user->avatar) }}"
                                            class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                            alt="Profile Picture">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>{{ $user->bio }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>{{ $user->email }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>Počet příspěvků: {{ DB::table('posts')->where('user_id', $user->id)->count() }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h6>Členem od {{ date('d.m.Y', strtotime($user->created_at)) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->id != $user->id)
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5 class="card-title text-center">{{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                    class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                    alt="Profile Picture">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="text-center">
                                @if ($user->bio != null || strlen($user->bio) > 0)
                                    <h6>{{ $user->bio }}</h6>
                                @else
                                    <h6>Uživatel nemá žádné bio.</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>Počet příspěvků: {{ $user->posts()->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>Členem od {{ date('d.m.Y', strtotime($user->created_at)) }}</h6>
                            </div>
                        </div>
                    </div>
                    @isset(Auth::user()->is_admin)
                        @if (Auth::user()->is_admin == 1)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fa-solid fa-trash me-2"></i>Smazat účet
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endisset
                    <div class="modal fade text-dark" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel"><i
                                            class="fa-solid fa-trash me-2"></i>Smazat účet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    Opravdu chcete smazat účet?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Zavřít</button>
                                    <form action="/profile/delete" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger">Smazat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="card shadow-lg">
            <div class="card-header">
                <h5 class="card-title text-center">{{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="img rounded-circle mx-auto d-block"
                                width="100px" height="100px" alt="Profile Picture">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            @if ($user->bio != null || strlen($user->bio) > 0)
                                <h6>{{ $user->bio }}</h6>
                            @else
                                <h6>Uživatel nemá žádné bio.</h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>Počet příspěvků: {{ $user->posts()->count() }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>Členem od {{ date('d.m.Y', strtotime($user->created_at)) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($posts->count() == 0)
            <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné příspěvky</h5>
        @else
            @foreach ($posts as $post)
                <div class="card mb-2 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center"><a class="card_header stretched-link link-dark"
                                href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            @if (strlen($post->content) > 100)
                                {!! substr($post->content, 0, 100) . '...' !!}
                            @else
                                {!! $post->content !!}
                            @endif
                        </div>
                        <div class="card-text mt-3">
                            <img src="{{ asset('storage/' .DB::table('users')->where('id', $post->user_id)->value('avatar')) }}"
                                class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                            {{ DB::table('users')->where('id', $post->user_id)->value('name') }} -
                            {{ date('d.m.Y', strtotime($post->created_at)) }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endauth
</x-layout>
