@if(count($posts) == 0)
    <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné příspěvky</h5>
@else
@foreach ($posts as $post)
        <a href="{{ route('post', $post->id) }}" wire:key="{{ $post->id }}" class="text-decoration-none text-dark">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $post->title }}</h5>
                    <h6>
                        <img src="{{ asset('storage/' .DB::table('subforums')->where('id', $post->subforum_id)->value('image')) }}"
                             class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                        <a href="{{ route('subforum', $post->subforum_id) }}" class="text-dark">
                            {{ DB::table('subforums')->where('id', $post->subforum_id)->value('name') }}
                        </a>
                    </h6>
                    <p class="card-text">{!! $post->content !!}</p>
                    @if($post->image != null)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image">
                    @endif

                <hr class="divider">
                <p class="card-text"><small class="text-muted">Vytvořeno {{ $post->created_at->diffForHumans() }}
                    uživatelem <a href="{{ route('profile', $post->user->id) }}"
                    class="text-decoration-none text-dark">{{ $post->user->name }}</a></small></p>
                </div>
            </div>
        </a>
@endforeach
@endif
