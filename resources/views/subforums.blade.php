<x-layout>
    <x-slot name="title">
        Subfóra
    </x-slot>
    <button type="button" class="btn btn-success mb-2 shadow-lg" data-bs-toggle="modal"
        @auth data-bs-target="#createSubforumModal" @endauth data-bs-target="#notLoggedInSubforumModal">
        Vytvořit subforum
    </button>
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade text-dark" id="notLoggedInSubforumModal" tabindex="-1"
                aria-labelledby="notLoggedInSubforumModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="notLoggedInSubforumModal">Vytvořit subforum</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            Pro vytvoření subfora se musíte přihlásit.
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
    @auth
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade text-dark" id="createSubforumModal" tabindex="-1"
                    aria-labelledby="createSubforumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createSubforumModalLabel">Vytvořit subforum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form action="subforum/create" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Název</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Maximálně 50 znaků">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Popis</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Povinné pole"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Obrázek</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Vytvořit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <livewire:subforumspage />
    <x-footer />
</x-layout>
