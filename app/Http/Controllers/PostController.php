<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function CreatePost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->subforum_id = $request->subforum_id;
        $post->save();

        return redirect()->route('subforum', ['id' => $request->subforum_id]);
    }

    function UploadPostImage(Request $request)
    {
    }

    function RedirectToPostPage($id)
    {
        $post = Post::find($id);
        $comments = DB::table('comments')->where('post_id', $id)->orderBy('created_at', 'desc')->get();
        return view('post', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    function DeletePost(Post $post)
    {
        $post->delete();
        return redirect()->route('subforum', ['id' => $post->subforum_id]);
    }
}
