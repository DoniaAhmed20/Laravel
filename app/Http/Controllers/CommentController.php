<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::find($request->post);
        $post->comments()->create($request->all());
        return redirect()->back();
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
    public function update($id,Request $request){
        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();

        return back();
    }
}
