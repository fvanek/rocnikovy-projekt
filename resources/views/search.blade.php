@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Výsledky hledání' }}</p>
    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title mb-0 text-center">Příspěvky</h5>
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
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
                @endforeach
            @else
                <h5 class="card-title mb-0 text-center alert alert-danger">Žádné výsledky</h5>
            @endif
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title mb-0 text-center">Subfora</h5>
        </div>
        <div class="card-body">
            @if ($subforums->count() > 0)
                @foreach ($subforums as $subforum)
                    <div class="card mb-2">
                        <div class="card-header">
                            <img src="{{ asset('storage/' .DB::table('subforums')->where('id', $subforum->id)->value('image')) }}"
                                class="img rounded-circle float-start me-2" width="40px" height="40px"
                                alt="Profile Picture">
                            <h5 class="card-title mb-0" style="margin-top: 7px;">
                                <a class="card_header stretched-link link-dark"
                                    href="{{ route('subforum', $subforum->id) }}">{{ $subforum->name }}</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                @if (strlen($subforum->description) > 100)
                                    {!! substr($subforum->description, 0, 100) . '...' !!}
                                @else
                                    {!! $subforum->description !!}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="card-title mb-0 text-center alert alert-danger">Žádné výsledky</h5>
            @endif
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header">
            <h5 class="card-title text-center">Uživatelé</h5>
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <div class="card mb-2">
                        <div class="card-header">
                            <img src="{{ asset('storage/' .DB::table('users')->where('id', $user->id)->value('avatar')) }}"
                                class="img rounded-circle float-start me-2" width="40px" height="40px"
                                alt="Profile Picture">
                            <h5 class="card-title mb-0" style="margin-top: 7px;">
                                <a class="card_header stretched-link link-dark"
                                    href="{{ route('profile', $user->id) }}">{{ $user->name }}</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                @if (strlen($user->bio) > 100)
                                    {!! substr($user->bio, 0, 100) . '...' !!}
                                @elseif($user->bio == null || strlen($user->bio) == 0)
                                    <p>Uživatel nemá bio</p>
                                @else
                                    {!! $user->bio !!}
                                @endif
                            </div>
                        </div>
                @endforeach
            @else
                <h5 class="card-title mb-0 text-center alert alert-danger">Žádné výsledky</h5>
            @endif
        </div>
    </div>
@endsection
