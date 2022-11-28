@extends('layouts.app')
@section('content')
    <p class="nav_title">
        {{ $nav_title = 'Příspěvek' }}</p>

    <div class="mb-2">
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-light"><i
                class="fa-solid fa-arrow-left me-1"></i>Zpět</a>

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
    @endsection
