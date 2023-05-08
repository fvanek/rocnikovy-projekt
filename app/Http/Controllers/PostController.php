<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostLike;
use App\Models\SubforumLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function CreatePost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        if ($request->hasFile('image')) {
            Storage::putFileAs('public/post_images', $request->file('image'), $request->file('image')->getClientOriginalName());
            $post->image = 'post_images/' . $request->file('image')->getClientOriginalName();
        } else {
            $post->image = null;
        }
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
        PostLike::where('post_id', $post->id)->delete();
        $post->delete();
        return redirect()->route('subforum', ['id' => $post->subforum_id]);
    }

    function RedirectToFavoritesPage()
    {
        if (!Auth::check())
            return redirect()->route('login');
        $likes = PostLike::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $posts = Post::whereIn('id', $likes->pluck('post_id'))->get();
        return view('favorites', [
            'posts' => $posts,
        ]);
    }

    function RedirectToMyPostsPage()
    {
        if (!Auth::check())
            return redirect()->route('login');
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('myposts', [
            'posts' => $posts,
        ]);
    }
}
