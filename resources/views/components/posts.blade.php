<x-layout>
    @if ($posts->count() == 0)
        <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné příspěvky</h5>
    @endif
    @foreach ($posts as $post)
        <a href="{{ route('post', $post->id) }}" class="text-decoration-none text-dark">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $post->title }}</h5>
                    <p class="card-text">{!! $post->content !!}</p>
        </a>
        <hr class="divider">
        <p class="card-text"><small class="text-muted">Vytvořeno {{ $post->created_at->diffForHumans() }}
                uživatelem <a href="{{ route('profile', $post->user->id) }}"
                    class="text-decoration-none text-dark">{{ $post->user->name }}</a></small></p>
        </div>
        </div>
    @endforeach
</x-layout>
