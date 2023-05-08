<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PostLike as ModelsPostLike;

class PostLike extends Component
{
    public $post;
    public $liked;
    public $count;

    public function mount($post)
    {
        $this->post = $post;
        if (auth()->check())
            $this->liked = ModelsPostLike::where('post_id', $post->id)->where('user_id', auth()->user()->id)->exists();
        else
            $this->liked = false;
        $this->count = ModelsPostLike::where('post_id', $post->id)->count();
    }

    public function like()
    {
        if (!auth()->check())
            return redirect()->route('login');
        else {
            if ($this->liked) {
                ModelsPostLike::where('post_id', $this->post->id)->where('user_id', auth()->user()->id)->delete();
                $this->liked = false;
                $this->count--;
            } else {
                ModelsPostLike::create([
                    'post_id' => $this->post->id,
                    'user_id' => auth()->user()->id
                ]);
                $this->liked = true;
                $this->count++;
            }
        }
    }

    public function render()
    {
        return view('livewire.post-like');
    }
}
