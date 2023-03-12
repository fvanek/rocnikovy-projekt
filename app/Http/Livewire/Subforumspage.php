<?php

namespace App\Http\Livewire;

use App\Models\Subforum;
use App\Models\SubforumLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subforumspage extends Component
{
    public $subforums;
    public $showlikes;

    public function mount()
    {
        $this->subforums = collect();
        $this->showlikes = false;
    }
    public function showLikes()
    {
        $this->showlikes = true;
    }

    public function showAll()
    {
        $this->showlikes = false;
    }

    public function render()
    {
            if($this->showlikes){
                $likes= SubforumLike::where('user_id', Auth::user()->id)->get();
                $likes = $likes->pluck('subforum_id');
                $this->subforums = Subforum::whereIn('id', $likes)->orderBy('created_at', 'desc')->get();
            }
            else{
                $this->subforums = Subforum::all()->sortByDesc('created_at');
            }

        return view('livewire.subforumspage',[
            'subforums' => $this->subforums,
            'showLikes' => $this->showlikes,
        ]);
    }
}
