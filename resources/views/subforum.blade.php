<x-layout>
    <x-backbutton class="mb-2" />
    <div class="card mb-2 shadow-lg">
        <div class="card-header">
            <h5 class="card-title post_card mb-1 ms-5">
                {{ $subforum->name }}
                @auth
                    <form id="like-form" action="{{ route('subforum/like') }}" method="POST" class="float-end">
                        @csrf
                        <input type="hidden" name="subforum_id" value="{{ $subforum->id }}">
                        <button type="submit" class="btn btn-light btn-sm mb-1" id="like-button">
                            @if (DB::table('subforum_likes')->where('subforum_id', $subforum->id)->where('user_id', Auth::user()->id)->exists())
                                <i class="fa-solid fa-heart me-1 text-danger" id="heart"></i>
                            @else
                                <i class="fa-solid fa-heart me-1" id="heart"></i>
                            @endif
                            <b id="like-count">{{ $subforum->likes()->count() }}</b>
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
                        <b>{{ DB::table('subforum_likes')->where('subforum_id', $subforum->id)->count() }}</b>
                    </button>
                @endauth
            </h5>
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
                                    Pro přidání subfora do oblíbených se musíte přihlásit.
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
        </div>
        <div class="card-body">
            <img src="{{ asset('storage/' . $subforum->image) }}" class="img rounded-circle mx-auto d-block"
                width="100px" height="115px" alt="Profile Picture">
            <p class="card-text text-center mt-1">{{ $subforum->description }}<br>
                {{ $subforum->posts->count() }}
                @if ($subforum->posts->count() == 1)
                    příspěvek
                @elseif($subforum->posts->count() >= 2 && $subforum->posts->count() <= 4)
                    příspěvky
                @else
                    příspěvků
                @endif
            </p>
            <p class="card-text text-center mt-1">Založil <a href="{{ route('profile', $subforum->user_id) }}"
                    class="text-dark" style="text-decoration: none;"><img
                        src="{{ asset('storage/' .DB::table('users')->where('id', $subforum->user_id)->value('avatar')) }}"
                        class="img rounded-circle mb-1" width="20px" height="20px" alt="Profile Picture">
                    {{ DB::table('users')->where('id', $subforum->user_id)->value('name') }}</a>
                @auth
                <div class="mb-2">
                    <button class="btn btn-success" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-plus me-1"></i>Přidat příspěvek</button>
                    @if ($subforum->user_id == Auth::id() || Auth::user()->is_admin == 1)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editSubforumModal">
                            Upravit
                        </button>
                        <div class="modal fade text-dark" id="editSubforumModal" tabindex="-1"
                            aria-labelledby="editSubforumModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSubforumModalLabel"><i
                                                class="fa-solid fa-pen-to-square me-1"></i>Upravit subforum</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <form action="{{ route('subforum/update', $subforum->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Název</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $subforum->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Popis</label>
                                                <textarea class="form-control" id="description" name="description" rows="3">{{ $subforum->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Obrázek</label>
                                                <input class="form-control" type="file" id="image"
                                                    name="image">
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Aktualizovat">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger subforum_delete" data-bs-toggle="modal"
                            data-bs-target="#deleteSubforumModal">
                            Smazat
                        </button>
                        <div class="modal fade text-dark" id="deleteSubforumModal" tabindex="-1"
                            aria-labelledby="deleteSubforumModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteSubforumModalLabel"><i
                                                class="fa-solid fa-trash me-2"></i>Smazat subforum</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        Opravdu chcete smazat subforum?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Zavřít</button>
                                        <form action="{{ route('subforum/delete', $subforum->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Smazat</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="collapse mt-3" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ route('post/create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Název</label>
                                    <input type="text" class="form-control" id="title" name="title" required
                                        placeholder="Maximálně 255 znaků">
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Obsah</label>
                                    <textarea class="tinymce form-control" id="content" name="content"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Obrázek</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                                <input type="hidden" name="subforum_id" value="{{ $subforum->id }}">
                                <input type="submit" class="btn btn-primary" value="Přidat">
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
    <x-posts :posts="$posts"/>
    <x-footer />
</x-layout>
