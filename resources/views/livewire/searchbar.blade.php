<div class="position-relative w-auto ms-lg-5">
    <div class="input-group">
        <input type="text" class="form-control mr-sm-2 border-2 rounded-start-3" placeholder="Hledat..." wire:model="query">
        @csrf
        <button class="btn btn-outline-secondary rounded-end-3" type="button" wire:click="resetData">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    @if($query != null)
        <div class="dropdown-menu show position-absolute w-100 rounded-3" style="z-index: 1000;">
            @if($posts->count() == 0 && $subforums->count() == 0 && $users->count() == 0)
                <a class="dropdown-item" href="#">Žádné výsledky</a>
            @else
                @if($posts->count() > 0)
                    <h6 class="dropdown-header"><strong>Příspěvky</strong></h6>
                    @foreach($posts as $post)
                        <a class="dropdown-item" href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
                    @endforeach
                @endif
                @if($subforums->count() > 0)
                    <h6 class="dropdown-header"><strong>Subfora</strong></h6>
                    @foreach($subforums as $subforum)
                        <a class="dropdown-item" href="{{ route('subforum', $subforum->id) }}">
                            <img src="{{ asset('storage/' . $subforum->image) }}" class="img-fluid" alt="Subforum Image" style="width: 20px; height: 20px; border-radius: 50%; margin-right: 5px;">
                            {{ $subforum->name }}</a>
                    @endforeach
                @endif
                @if($users->count() > 0)
                    <h6 class="dropdown-header"><strong>Uživatelé</strong></h6>
                    @foreach($users as $user)
                        <a class="dropdown-item" href="{{ route('profile', $user->id) }}">
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid" alt="User Avatar" style="width: 20px; height: 20px; border-radius: 50%; margin-right: 5px;">
                            {{ $user->name }}</a>
                    @endforeach
                @endif
            @endif
        </div>
    @endif
</div>
