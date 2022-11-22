<?php

namespace App\Http\Controllers;

use App\Models\Subforum;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Reflector;

class SubforumController extends Controller
{
    function RedirectToSubforumsPage()
    {
        return view('subforums', [
            'subforums' => Subforum::all(),
        ]);
    }

    function CreateSubforum(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subforums',
            'description' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        dd($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension();
            $image->storeAs('subforum_images', $imageName, 'public');
            $imagePath = 'subforum_images/' . $imageName;
        } else {
            $imagePath = 'subforum_images/default.png';
        }



        Subforum::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('subforums');
    }
}