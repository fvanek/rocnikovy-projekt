@extends('layouts.app')
@section('content')
    <p class="nav_title">
        {{ $nav_title = 'Příspěvek' }}</p>

    <div class="mb-2">
        <a href="{{ route('subforum', $post->subforum_id) }}" class="btn btn-light"><i
                class="fa-solid fa-arrow-left me-1"></i>Zpět</a>
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
                                <form action="/post/{{ $post->id }}" method="POST">
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
            <h5 class="card-title mb-0 text-center">{{ $post->title }}</h5>
        </div>
        <div class="card-body">
            {{ $post->content }}
            <p class="card-text mb-2">Vytvořeno {{ date('d.m.Y', strtotime($post->created_at)) }}
            <p class="card-text">
                <img src="{{ asset('storage/' .DB::table('users')->where('id', $post->user_id)->value('avatar')) }}"
                    class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                {{ DB::table('users')->where('id', $post->user_id)->value('name') }}
            </p>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <p class="card-text mb-0">Komentáře</p>
                </div>
                <div class="col text-end">
                    @auth
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addCommentModal">
                            <i class="fa-solid fa-comment-plus me-1"></i>Přidat komentář</button>
                    @endauth
                </div>
            </div>

            <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCommentModalLabel">Přidat komentář</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <i class="fa-solid fa-trash me-1"></i></button>

                                        <div class="modal fade text-start" id="deleteCommentModal{{ $comment->id }}"
                                            tabindex="-1" aria-labelledby="deleteCommentModalLabel{{ $comment->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteCommentModalLabel{{ $comment->id }}">Smazat
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
                        <p class="card-text">
                            <img src="{{ asset('storage/' .DB::table('users')->where('id', $comment->user_id)->value('avatar')) }}"
                                class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                            {{ DB::table('users')->where('id', $comment->user_id)->value('name') }}<br>
                            {{ date('d.m.Y', strtotime($comment->created_at)) }}
                        </p>
            @endforeach
        </div>
    </div>
@endsection
