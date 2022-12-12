@extends('layouts.app')
@section('content')
    <p class="nav_title">
        {{ $nav_title = 'Příspěvek' }}</p>
    <div class="mb-2">
        <a href="{{ route('subforum', ['id' => $post->subforum->id]) }}" class="btn btn-light"><i
                class="fa-solid fa-arrow-left me-1"></i>Zpět na subforum</a>
        @auth
            @if (Auth::user()->id == $post->user_id)
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                    <i class="fa-solid fa-trash me-1"></i>Smazat příspěvek</button>

                <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePostModalLabel">Smazat příspěvek</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                Opravdu chcete smazat příspěvek?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                                <form action="{{ route('post/delete', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title post_card mb-1">
                {{ $post->title }}
                @auth
                    <form action="{{ route('post/like') }}" method="POST" class="float-end">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-light btn-sm mb-1">
                            @if (DB::table('likes')->where('post_id', $post->id)->where('user_id', Auth::user()->id)->exists())
                                <i class="fa-solid fa-heart-circle-xmark text-danger me-1"></i>
                            @else
                                <i class="fa-solid fa-heart-circle-plus me-1"></i>
                            @endif
                            <b>{{ DB::table('likes')->where('post_id', $post->id)->count() }}</b>
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-light btn-sm float-end mb-1" data-bs-toggle="modal"
                        data-bs-target="#notLoggedInLikeModal">
                        <i class="fa-solid fa-heart-circle-plus me-1"></i>
                        <b>{{ DB::table('likes')->where('post_id', $post->id)->count() }}</b>
                    </button>
                @endauth
            </h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade text-dark" id="notLoggedInLikeModal" tabindex="-1"
                        aria-labelledby="notLoggedInLikeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notLoggedInLikeModal">Přidat do oblíbených</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    Pro přidání příspěvku do oblíbených se musíte přihlásit.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Přihlásit se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-text">
                <img src="{{ asset('storage/' .DB::table('users')->where('id', $post->user_id)->value('avatar')) }}"
                    class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                {{ DB::table('users')->where('id', $post->user_id)->value('name') }}
            </div>
            <div class="card-text">{{ date('d.m.Y', strtotime($post->created_at)) }}</div>
            <hr class="divider">
            <div class="card-text mb-1 mt-3">{!! $post->content !!}</div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <p class="card-text mt-1">Komentáře</p>
                </div>
                <div class="col text-end">
                    @auth
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addCommentModal">
                            Přidat komentář</button>
                    @endauth
                </div>
            </div>
            <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCommentModalLabel">Přidat komentář</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/comment/create" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Obsah</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                                <button type="submit" class="btn btn-primary">Přidat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @foreach ($comments as $comment)
                <div class="card mb-2 mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                {{ $comment->content }}
                            </div>
                            <div class="col text-end">
                                @auth
                                    @if (Auth::user()->id == $comment->user_id)
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteCommentModal{{ $comment->id }}">
                                            <i class="fa-solid fa-trash"></i></button>

                                        <div class="modal fade text-start" id="deleteCommentModal{{ $comment->id }}"
                                            tabindex="-1" aria-labelledby="deleteCommentModalLabel{{ $comment->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteCommentModalLabel{{ $comment->id }}">
                                                            Smazat
                                                            komentář</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        Opravdu chcete smazat komentář?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Zavřít</button>
                                                        <form action="/comment/{{ $comment->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Smazat</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-text mt-2">
                            <img src="{{ asset('storage/' .DB::table('users')->where('id', $comment->user_id)->value('avatar')) }}"
                                class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                            {{ DB::table('users')->where('id', $comment->user_id)->value('name') }}
                        </div>
                        <div class="card-text">
                            {{ date('d.m.Y', strtotime($comment->created_at)) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
