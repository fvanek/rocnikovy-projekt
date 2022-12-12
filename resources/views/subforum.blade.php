@extends('layouts.app')
@section('content')
    <p class="nav_title">
        {{ $nav_title = 'Subforum' }}</p>
    <a href="{{ route('subforums') }}" class="btn btn-light mb-2"><i class="fa-solid fa-arrow-left me-1"></i>Zpět</a>
    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title mb-0 text-center">{{ $subforum->name }}</h5>
        </div>
        <div class="card-body">
            <img src="{{ asset('storage/' . $subforum->image) }}" class="img rounded-circle mx-auto d-block" width="100px"
                height="100px" alt="Profile Picture">
            <p class="card-text text-center mt-1">{{ $subforum->description }}<br>
                {{ $subforum->posts->count() }}
                @if ($subforum->posts->count() == 1)
                    příspěvek
                @elseif($subforum->posts->count() >= 2 && $subforum->posts->count() <= 4)
                    příspěvky
                @else
                    příspěvků
                @endif
            </p>
            @auth
                <div class="mb-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-plus me-1"></i>Přidat příspěvek</button>
                    @if ($subforum->user_id == Auth::id())
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#editSubforumModal">
                            Upravit
                        </button>
                        <div class="modal fade text-dark" id="editSubforumModal" tabindex="-1"
                            aria-labelledby="editSubforumModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSubforumModalLabel"><i
                                                class="fa-solid fa-pen-to-square me-1"></i>Upravit subforum</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <form action="{{ route('subforum/update', $subforum->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Název</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $subforum->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Popis</label>
                                                <textarea class="form-control" id="description" name="description" rows="3">{{ $subforum->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Obrázek</label>
                                                <input class="form-control" type="file" id="image" name="image">
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Aktualizovat">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteSubforumModal">
                            Smazat
                        </button>
                        <div class="modal fade text-dark" id="deleteSubforumModal" tabindex="-1"
                            aria-labelledby="deleteSubforumModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteSubforumModalLabel"><i
                                                class="fa-solid fa-trash me-2"></i>Smazat subforum</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Opravdu chcete smazat subforum?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                                        <form action="{{ route('subforum/delete', $subforum->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Smazat</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="collapse mt-3" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ route('post/create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Název</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Obsah</label>
                                    <textarea class="tinymce form-control" id="content" name="content"></textarea>
                                </div>
                                <input type="hidden" name="subforum_id" value="{{ $subforum->id }}">
                                <input type="submit" class="btn btn-primary" value="Přidat">
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
    @foreach ($posts as $post)
        <div class="container">
            <div class="card mb-2">
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
        </div>
    @endforeach
@endsection
