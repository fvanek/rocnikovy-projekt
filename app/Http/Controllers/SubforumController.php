<?php

namespace App\Http\Controllers;

use Reflector;
use App\Model\Post;
use App\Models\Subforum;
use Termwind\Components\Dd;
use App\Models\SubforumLike;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubforumController extends Controller
{
    function RedirectToSubforumsPage()
    {
        return view('subforums', [
            'subforums' => Subforum::all(),
        ]);
    }

    function RedirectToSubforumPage($id)
    {
        $subforum = Subforum::find($id);
        return view('subforum', [
            'subforum' => $subforum,
            'posts' => DB::table('posts')->where('subforum_id', $id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    function CreateSubforum(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subforums|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $subforum = new Subforum();
        $subforum->name = $request->name;
        $subforum->description = $request->description;
        if ($request->hasFile('image')) {
            Storage::putFileAs('public/subforum_images', $request->file('image'), $request->file('image')->getClientOriginalName());
            $subforum->image = 'subforum_images/' . $request->file('image')->getClientOriginalName();
        } else {
            $subforum->image = 'subforum_images/default.png';
        }
        $subforum->user_id = Auth::id();
        $subforum->save();

        return redirect()->route('subforums');
    }

    function DeleteSubforum(Subforum $subforum)
    {
        $posts = DB::table('posts')->where('subforum_id', $subforum->id)->get();
        foreach ($posts as $post) {
            DB::table('comments')->where('post_id', $post->id)->delete();
        }
        DB::table('posts')->where('subforum_id', $subforum->id)->delete();
        if ($subforum->image != 'subforum_images/default.png') {
            Storage::delete('public/' . $subforum->image);
        }

        $subforum->delete();
        return redirect()->route('subforums');
    }

    function UpdateSubforum(Request $request, Subforum $subforum)
    {
        $subforum->name = $request->name;
        $subforum->description = $request->description;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($subforum->image);
            Storage::putFileAs('public/subforum_images', $request->file('image'), $request->file('image')->getClientOriginalName());
            $subforum->image = 'subforum_images/' . $request->file('image')->getClientOriginalName();
        }
        $subforum->save();
        return redirect()->route('subforum', $subforum->id);
    }

    function LikeSubforum(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');

        $user = Auth::user();

        $like = SubforumLike::where('subforum_id', $request->subforum_id)->where('user_id', Auth::id())->first();
        if ($like == null) {
            $like = new SubforumLike();
            $like->subforum_id = $request->subforum_id;
            $like->user_id = Auth::id();
            $like->save();
            return response()->json(['success' => true, 'message' => 'Like added']);
        } else {
            $like->delete();
            return response()->json(['success' => true, 'message' => 'Like removed']);
        }
    }
}
