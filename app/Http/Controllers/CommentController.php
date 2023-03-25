<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $post = Post::find($id);
        $request["user_id"]=Auth::id()??1;
        //dd($request->all());
        $post->comments()->create($request->all());
        return redirect()->back();
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
    public function update($id, Request $request)
    {
        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }
}
