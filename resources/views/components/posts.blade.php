@if(count($posts) == 0)
    <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné příspěvky</h5>
@else
@foreach ($posts as $post)
        <a href="{{ route('post', $post->id) }}" wire:key="{{ $post->id }}" class="text-decoration-none text-dark">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        {{ $post->title }}
                        <div class="float-end">
                        @auth
                            @if ($post->likes()->where('post_id', $post->id)->where('user_id', Auth::user()->id)->exists())
                                <i class="fa-solid fa-heart me-1 text-danger" id="heart"></i>
                            @else
                                <i class="fa-solid fa-heart me-1" id="heart"></i>
                            @endif
                            <span id="like-count">{{ $post->likes()->count() }}</span>
                        @else
                            <i class="fa-solid fa-heart me-1" id="heart"></i>
                            <span id="like-count">{{ $post->likes()->count() }}</span>
                        @endauth
                        </div>
                    </h5>
                    <h6>
                        Subforum: <x-subforumlink :subforum="$post->subforum" />
                    </h6>
                    <a class="text-decoration-none text-dark" href="{{ route('post', $post->id) }}">
                        <p class="card-text">{!! $post->content !!}</p>
                    </a>
                    @if($post->image != null)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image">
                    @endif

                <hr class="divider">
                <p class="card-text"><small class="text-muted">Vytvořeno {{ $post->created_at->diffForHumans() }}
                    uživatelem <br>
                        <x-userlink :user="$post->user" />
                    </small>
                </div>
            </div>
        </a>
@endforeach
@endif
