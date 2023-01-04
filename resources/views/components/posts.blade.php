<x-layout>
    @if ($posts->count() == 0)
        <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné příspěvky</h5>
    @endif
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
</x-layout>
