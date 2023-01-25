<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Subforum;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function Search(Request $request)
    {
        if ($request->input('search') == null)
            return back()->withErrors(['search' => 'Pole vyhledávání nesmí být prázdné']);
        $request->validate([
            'search' => 'required|string'
        ]);
        $search = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $search . '%')->get();
        $subforums = Subforum::where('name', 'like', '%' . $search . '%')->get();
        $users = User::where('name', 'like', '%' . $search . '%')->get();
        return view('search', compact('posts', 'subforums', 'users'));
    }
}