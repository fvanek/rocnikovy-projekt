<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    function LikePost(Request $request)
    {
        if (Like::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->exists()) {
            Like::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->delete();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->post_id,
            ]);
        }
        return redirect()->route('post', ['id' => $request->post_id]);
    }
}