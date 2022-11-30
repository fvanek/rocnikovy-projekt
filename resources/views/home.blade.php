@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Nejnovější příspěvky' }}</p>
    <div class="row">
        <div class="col">
            @if ($posts->count() == 0)
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Žádné příspěvky</h4>
                    <p>Nic tu není <i class="fa-solid fa-face-sad-tear"></i></p>
                </div>
            @else
                @foreach ($posts as $post)
                    <div class="card mb-2">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><a class="card_header stretched-link link-dark"
                                    href="{{ route('post', $post->id) }}">{{ $post->title }}</a></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Vytvořeno {{ date('d.m.Y', strtotime($post->created_at)) }}</p>
                            <p class="card-text">
                                <img src="{{ asset('storage/' .DB::table('users')->where('id', $post->user_id)->value('avatar')) }}"
                                    class="img rounded-circle me-1" width="30px" height="30px" alt="Profile Picture">
                                {{ DB::table('users')->where('id', $post->user_id)->value('name') }}
                            </p>
                            <p class="card-text">{{ substr($post->content, 0, 100) }}...</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
