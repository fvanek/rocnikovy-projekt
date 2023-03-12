<div>
    @if ($message != '')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-10">
            <div class="mb-2 mt-lg-2">
                <button @class(['btn btn-outline-light', 'active' => $users]) wire:click="showUsers">
                    <i class="fa-solid fa-user"></i> Uživatelé
                </button>
                <button @class(['btn btn-outline-light', 'active' => $posts]) wire:click="showPosts">
                    <i class="fa-solid fa-pen-to-square"></i> Příspěvky
                </button>
                <button @class(['btn btn-outline-light', 'active' => $subforums]) wire:click="showSubforums">
                    <i class="fa-regular fa-comments"></i> Subfora
                </button>
                <div wire:loading wire:target="showUsers, showPosts, showSubforums">
                    <img src="{{ asset('storage/loading.gif') }}" alt="Loading..." style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="container bg-light rounded-3 py-2">
                @if ($users)
                    <livewire:user-table />
                @endif
                @if ($posts)
                    <livewire:post-table />
                @endif
                @if ($subforums)
                    <livewire:subforum-table />
                @endif
            </div>
        </div>
        <div class="col-lg-2 mt-lg-5">
            <div class="container bg-light rounded-3 mt-2 pt-2">
                <button class="btn btn-outline-danger mb-2" wire:click="AppCacheClear">
                    <i class="fa-solid fa-trash"></i> Vymazat app cache
                </button>
                <button class="btn btn-outline-danger mb-2" wire:click="RouteCacheClear">
                    <i class="fa-solid fa-trash"></i> Vymazat route cache
                </button>
                <button class="btn btn-outline-danger mb-2" wire:click="ConfigCacheClear">
                    <i class="fa-solid fa-trash"></i> Vymazat config cache
                </button>
                <button class="btn btn-outline-danger mb-2" wire:click="ViewCacheClear">
                    <i class="fa-solid fa-trash"></i> Vymazat view cache
                </button>
                <button class="btn btn-outline-danger mb-2" wire:click="ClearAll">
                    <i class="fa-solid fa-trash"></i> Vymazat všechny cache
                </button>
                <button class="btn btn-outline-danger mb-2" wire:click="LinkStorage">
                    <i class="fa-solid fa-trash"></i> Link storage
                </button>
            </div>
        </div>
    </div>
</div>
