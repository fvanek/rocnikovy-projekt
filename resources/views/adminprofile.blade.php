<x-layout>
    <x-slot name="title">
        {{ $user->name }}
    </x-slot>
    <div class="card shadow-lg mb-3">
        <div class="card-header">
            <h5 class="card-title text-center">{{ $user->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="img rounded-circle mx-auto d-block"
                             width="100px" height="100px" alt="Profile Picture">
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="text-center">
                        @if ($user->bio != null || strlen($user->bio) > 0)
                            <h6>{{ $user->bio }}</h6>
                        @else
                            <h6>Uživatel nemá žádné bio.</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="text-center">
                        <h6>Počet příspěvků: {{ $user->posts()->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="text-center">
                        <h6>Členem od {{ date('d.m.Y', strtotime($user->created_at)) }}</h6>
                    </div>
                </div>
            </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash me-2"></i>Smazat účet
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <x-posts :posts="$posts" />
    <div class="modal fade text-dark" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"><i
                            class="fa-solid fa-trash me-2"></i>Smazat účet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Opravdu chcete smazat účet?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Zavřít</button>
                    <form action="{{ route('profile/delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-danger">Smazat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-layout>

