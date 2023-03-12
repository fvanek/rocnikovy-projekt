<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Subforum;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $posts;
    public $subforums;
    public $users;
    public $message;

    public function mount()
    {
        $this->posts = false;
        $this->subforums = false;
        $this->users = true;
        $this->message = "";
    }

    public function showPosts()
    {
        $this->posts = true;
        $this->subforums = false;
        $this->users = false;
    }

    public function showSubforums()
    {
        $this->posts = false;
        $this->subforums = true;
        $this->users = false;
    }

    public function showUsers()
    {
        $this->posts = false;
        $this->subforums = false;
        $this->users = true;
    }

    public function AppCacheClear()
    {
        Artisan::call('cache:clear');
        $this->message = "App Cache cleared";
    }

    public function RouteCacheClear()
    {
        Artisan::call('route:cache');
        $this->message = "Route Cache cleared";
    }

    public function ConfigCacheClear()
    {
        Artisan::call('config:cache');
        $this->message = "Config Cache cleared";
    }

    public function ViewCacheClear()
    {
        Artisan::call('view:clear');
        $this->message = "View Cache cleared";
    }

    public function LinkStorage()
    {
        Artisan::call('storage:link');
        $this->message = "Storage linked";
    }

    public function ClearAll()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('storage:link');
        $this->message = "All caches cleared";
    }

    public function render()
    {
        return view('livewire.admin-dashboard', [
            'posts' => $this->posts,
            'subforums' => $this->subforums,
            'users' => $this->users,
            'message' => $this->message
        ]);
    }
}
