<a href="{{ route('profile', $user->id) }}"
   class="text-decoration-none text-dark" data-bs-toggle="popover" data-bs-title="{{ $user->name }}" data-bs-content="{{ $user->bio ?? 'Uživatel nemá bio' }}">
    <img src="{{ asset('storage/' . DB::table('users')->where('id', $user->id)->value('avatar')) }}"
         class="rounded-circle" style="width: 20px; height: 20px;" alt="Avatar"> {{ $user->name }}
</a>
