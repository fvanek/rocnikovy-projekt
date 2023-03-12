<x-layout>
    <x-slot name="title">
        {{ $post->title }}
    </x-slot>
    <div class="mb-2">
        <x-backbutton />
        @auth
            @if (Auth::user()->id == $post->user_id || Auth::user()->is_admin == 1 || Auth::user()->id == $post->subforum->user_id)
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                    <i class="fa-solid fa-trash me-1"></i>Smazat příspěvek</button>

                <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePostModalLabel">Smazat příspěvek</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                Opravdu chcete smazat příspěvek?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                                <form action="{{ route('post/delete', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
    <div class="card mb-2 shadow-lg">
        <div class="card-header">
            <h5 class="card-title post_card mb-1">
                {{ $post->title }}
                @auth
                    <form id="like-form" action="{{ route('post/like') }}" method="POST" class="float-end">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-light btn-sm mb-1" id="like-button">
                            @if (DB::table('post_likes')->where('post_id', $post->id)->where('user_id', Auth::user()->id)->exists())
                                <i class="fa-solid fa-heart me-1 text-danger" id="heart"></i>
                            @else
                                <i class="fa-solid fa-heart me-1" id="heart"></i>
                            @endif
                            <span id="like-count">{{ $post->likes()->count() }}</span>
                        </button>
                    </form>
                    <script>
                        $('#like-form').on('submit', function(event) {
                            event.preventDefault();

                            $.ajax({
                                url: $(this).attr('action'),
                                method: $(this).attr('method'),
                                data: $(this).serialize(),
                                success: function(response) {
                                    if (response.success && response.message == 'Like added') {
                                        $('#heart').addClass('text-danger');
                                        var likeCount = parseInt($('#like-count').text()) + 1;
                                        $('#like-count').text(likeCount);
                                    } else if (response.success && response.message == 'Like removed') {
                                        $('#heart').removeClass('text-danger');
                                        var likeCount = parseInt($('#like-count').text()) - 1;
                                        $('#like-count').text(likeCount);
                                    }
                                }
                            });
                        });
                    </script>
                @else
                    <button type="button" class="btn btn-light btn-sm float-end mb-1" data-bs-toggle="modal"
                            data-bs-target="#notLoggedInLikeModal">
                        <i class="fa-solid fa-heart me-1"></i>
                        <b>{{ DB::table('post_likes')->where('post_id', $post->id)->count() }}</b>
                    </button>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal fade text-dark" id="notLoggedInLikeModal" tabindex="-1"
                                 aria-labelledby="notLoggedInLikeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="notLoggedInLikeModal">Přidat do oblíbených</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            Pro přidání příspěvku do oblíbených se musíte přihlásit.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Zavřít</button>
                                            <a href="{{ route('login') }}" class="btn btn-primary">Přihlásit se</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth
            </h5>
        </div>
        <div class="card-body">
            <div class="card-text">
                <h5>
                    Subforum: <x-subforumlink :subforum="$post->subforum" />
                </h5>
                <hr class="divider">
                <x-userlink :user="$post->user" />
            </div>
            <div class="card-text">{{ date('d.m.Y', strtotime($post->created_at)) }}</div>
            <div class="card-text mb-1 mt-3">{!! $post->content !!}</div>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image">
            @endif
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <p class="card-text mt-1">Komentáře</p>
                </div>
                <div class="col text-end">
                    @auth
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addCommentModal">
                            Přidat komentář</button>
                    @else
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#notLoggedInCommentModal">
                            Přidat komentář</button>
                    @endauth
                </div>
            </div>
            <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCommentModalLabel">Přidat komentář</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/comment/create" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Obsah</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Zavřít</button>
                                <button type="submit" class="btn btn-primary">Přidat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="notLoggedInCommentModal" tabindex="-1"
                aria-labelledby="notLoggedInCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="notLoggedInCommentModalLabel">Přidat komentář</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                Pro přidání komentáře se musíte přihlásit.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                            <a href="{{ route('login') }}" class="btn btn-primary">Přihlásit se</a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($comments as $comment)
                <div class="card mb-2 mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                {{ $comment->content }}
                            </div>
                            <div class="col text-end">
                                @auth
                                    @if (Auth::user()->id == $comment->user_id ||
                                            Auth::user()->is_admin == 1 ||
                                            Auth::user()->id == $post->subforum->user_id)
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteCommentModal{{ $comment->id }}">
                                            <i class="fa-solid fa-trash"></i></button>

                                        <div class="modal fade text-start" id="deleteCommentModal{{ $comment->id }}"
                                            tabindex="-1" aria-labelledby="deleteCommentModalLabel{{ $comment->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deleteCommentModalLabel{{ $comment->id }}">
                                                            Smazat
                                                            komentář</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        Opravdu chcete smazat komentář?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Zavřít</button>
                                                        <form action="/comment/{{ $comment->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Smazat</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-text mt-2">
                            <hr class="divider">
                            <img src="{{ asset('storage/' .DB::table('users')->where('id', $comment->user_id)->value('avatar')) }}"
                                class="img rounded-circle" width="30px" height="30px" alt="Profile Picture">
                            <a href="{{ route('profile', $comment->user_id) }}"
                                class="text-dark">{{ DB::table('users')->where('id', $comment->user_id)->value('name') }}</a>
                        </div>
                        <div class="card-text">
                            {{ date('d.m.Y', strtotime($comment->created_at)) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-footer />
</x-layout>
