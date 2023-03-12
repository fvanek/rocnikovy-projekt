<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Subforum;
use App\Models\SubforumLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use mysql_xdevapi\Collection;

class Homepageposts extends Component
{
    public $posts;
    public $showLikes;

    public function mount()
    {
        $this->posts = collect();
        $this->showLikes = false;
    }

    public function showLikes()
    {
        $this->showLikes = true;
    }

    public function showAll()
    {
        $this->showLikes = false;
    }
    public function render()
    {
       if($this->showLikes){
           $subforumLikes = SubforumLike::where('user_id', Auth::user()->id)->get();
              $subforumLikes = $subforumLikes->pluck('subforum_id');
                $this->posts = Post::whereIn('subforum_id', $subforumLikes)->orderBy('created_at', 'desc')->get();
       }
       else{
           $this->posts = Post::orderBy('created_at', 'desc')->get();
       }
        return view('livewire.homepageposts', [
            'posts' => $this->posts
        ]);
    }
}
