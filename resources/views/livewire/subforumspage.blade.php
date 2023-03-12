<div>
    @auth
        <div class="mb-2">
            <button @class(['btn btn-outline-light', 'active' => !$showLikes]) wire:click.debounce.500ms="showAll">
                Všechny subfora
            </button>
            <button @class(['btn btn-outline-light', 'active' => $showLikes]) wire:click.debounce.500ms="showLikes">
                Sleduji
            </button>
            <div wire:loading wire:target="showAll, showLikes">
                <img src="{{ asset('storage/loading.gif') }}" alt="Loading..." style="width: 20px; height: 20px;">
            </div>
        </div>
    @endauth
    @forelse ($subforums as $subforum)
        <div class="card mb-2 shadow-lg">
            <div class="card-header position-relative">
                <h5 class="card-title text-center">
                    <a class="card_header stretched-link link-dark" href="{{ route('subforum', $subforum->id) }}">
                        {{ $subforum->name }}
                        <div class="float-end">
                            @auth
                                @if ($subforum->likes()->where('subforum_id', $subforum->id)->where('user_id', Auth::user()->id)->exists())
                                    <i class="fa-solid fa-heart me-1 text-danger" id="heart"></i>
                                @else
                                    <i class="fa-solid fa-heart me-1" id="heart"></i>
                                @endif
                                <b id="like-count">{{ $subforum->likes()->count() }}</b>
                            @else
                                <i class="fa-solid fa-heart me-1" id="heart"></i>
                                <b id="like-count">{{ $subforum->likes()->count() }}</b>
                            @endauth
                        </div>
                    </a>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $subforum->image) }}"
                                class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                alt="Profile Picture">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>{{ $subforum->description }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>{{ $subforum->posts->count() }}
                                @if ($subforum->posts->count() == 1)
                                    příspěvek
                                @elseif($subforum->posts->count() >= 2 && $subforum->posts->count() <= 4)
                                    příspěvky
                                @else
                                    příspěvků
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>Vytvořeno {{ date('d.m.Y', strtotime($subforum->created_at)) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h5 class="card-title mb-0 text-center alert alert-secondary">Žádné subfóra</h5>
    @endforelse
</div>
