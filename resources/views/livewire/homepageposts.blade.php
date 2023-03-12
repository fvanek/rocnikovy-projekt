<div>
    @auth
        <div class="mb-2">
            <button @class(['btn btn-outline-light', 'active' => !$showLikes]) wire:click="showAll">
                Všechny příspěvky
            </button>
            <button @class(['btn btn-outline-light', 'active' => $showLikes]) wire:click="showLikes">
                Sleduji
            </button>
            <div wire:loading wire:target="showAll, showLikes">
                <img src="{{ asset('storage/loading.gif') }}" alt="Loading..." style="width: 20px; height: 20px;">
            </div>
        </div>
    @endauth
    <x-posts :posts="$posts" />
</div>
