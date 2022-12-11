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
                            <h5 class="card-title mb-0 text-center"><a class="card_header stretched-link link-dark"
                                    href="{{ route('post', $post->id) }}">{{ $post->title }}</a></h5>
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
        </div>
    </div>
@endsection
