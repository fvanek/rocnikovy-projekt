<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Subforum;
use App\Models\User;
use Livewire\Component;

class Searchbar extends Component
{
    public $query;
    public $posts;
    public $subforums;
    public $users;

    public function mount()
    {
        $this->resetData();
    }

    public function resetData()
    {
        $this->query = '';
        $this->posts = collect();
        $this->subforums = collect();
        $this->users = collect();
    }

    public function updatedQuery()
    {
        $this->posts = Post::where('title', 'LIKE', "%{$this->query}%")
            ->get();
        $this->subforums = Subforum::where('name', 'LIKE', "%{$this->query}%")
            ->get();
        $this->users = User::where('name', 'LIKE', "%{$this->query}%")
            ->get();
    }
    public function render()
    {
        return view('livewire.searchbar', [
            'posts' => $this->posts,
            'subforums' => $this->subforums,
            'users' => $this->users
        ]);
    }
}
