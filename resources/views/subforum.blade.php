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
                                    <textarea class="form-control tinymce" id="content" name="content" rows="3" required></textarea>
                                </div>
                                <input type="hidden" name="subforum_id" value="{{ $subforum->id }}">
                                <input type="submit" class="btn btn-primary" value="Přidat">
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    @foreach ($posts as $post)
        <div class="card mb-2">
            <div class="card-header">
                <h5 class="card-title mb-0 text-center"><a href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text">Vytvořeno {{ date('d.m.Y', strtotime($post->created_at)) }}</p>
                <p class="card-text">
                    <img src="{{ asset('storage/' .DB::table('users')->where('id', $post->user_id)->value('avatar')) }}"
                        class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                    {{ DB::table('users')->where('id', $post->user_id)->value('name') }}
                </p>
            </div>
        </div>
    @endforeach
@endsection
