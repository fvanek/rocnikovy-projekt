<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
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

    function RedirectToPostPage($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        return view('post', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    function DeletePost(Post $post)
    {
        Comment::where('post_id', $post->id)->delete();
        Like::where('post_id', $post->id)->delete();
        $post->delete();
        return redirect()->route('subforum', ['id' => $post->subforum_id]);
    }

    function RedirectToFavoritesPage()
    {
        $posts = Like::join('posts', 'likes.post_id', '=', 'posts.id')
            ->where('likes.user_id', Auth::id())
            ->orderBy('likes.created_at', 'desc')
            ->get();
        return view('favorites', [
            'posts' => $posts,
        ]);
    }

    function RedirectToMyPostsPage()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('myposts', [
            'posts' => $posts,
        ]);
    }
}
