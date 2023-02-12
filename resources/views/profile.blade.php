<x-layout>
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title mb-0 text-center">{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img src="{{ asset('storage/' . $user->avatar) }}" class="img rounded-circle mx-auto d-block"
                     width="100px" height="100px" alt="Profile Picture">
            </div>
            <div class="text-center">
                @if ($user->bio != null || strlen($user->bio) > 0)
                    <h6>{{ $user->bio }}</h6>
                @else
                    <h6>Uživatel nemá žádné bio.</h6>
                @endif
                <hr class="divider">
                <h6>Napsaných příspěvků: {{ $user->posts()->count() }}</h6>
                <h6>Členem od: {{ date('d.m.Y', strtotime($user->created_at)) }}</h6>
            </div>
        </div>
    </div>
    <x-footer />
</x-layout>
