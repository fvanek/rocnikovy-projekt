<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SubforumLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function home()
    {
        //if the user is logged in, show only the posts from subforums the user has liked
        if (Auth::check()) {
            $likes = SubforumLike::where('user_id', Auth::id())->get();
            if ($likes->isEmpty()) {
                return view('components.posts', [
                    'posts' => Post::orderBy('created_at', 'desc')->get(),
                ]);
            } else {
                $subforums = [];
                foreach ($likes as $like) {
                    array_push($subforums, $like->subforum_id);
                }
                return view('components.posts', [
                    'posts' => Post::whereIn('subforum_id', $subforums)->orderBy('created_at', 'desc')->get(),
                ]);
            }
        }
        return view('components.posts', [
            'posts' => Post::orderBy('created_at', 'desc')->get(),
        ]);
    }
}