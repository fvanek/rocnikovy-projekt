<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function CreateComment(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->save();

        return redirect()->route('post', ['id' => $request->post_id]);
    }

    function DeleteComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('post', ['id' => $comment->post_id]);
    }
}
