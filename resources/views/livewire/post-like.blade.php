<button @auth wire:click="like" @else data-bs-toggle="modal"
    data-bs-target="#notLoggedInLikeModal" @endauth
    class="btn btn-light btn-sm mb-1 float-end">
    <i @class(['fa-solid fa-heart me-1', 'text-danger' => $liked])></i>
    <span>{{ $count }}</span>
</button>
<div class="row">
    <div class="col-md-12">
        <div class="modal fade text-dark" id="notLoggedInLikeModal" tabindex="-1"
            aria-labelledby="notLoggedInLikeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notLoggedInLikeModal">Přidat do oblíbených</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        Pro přidání příspěvku do oblíbených se musíte přihlásit.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Přihlásit se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
