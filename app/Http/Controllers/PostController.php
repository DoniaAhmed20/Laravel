<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;


//use App\Http\Requests\UpdatePostName;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all(); //select * from posts

        return view('post.index', ['posts' => $allPosts]);
    }

    ///////////////////////////////////show//////////////////////

    public function show($id)
    {
        //        $post = Post::find($id); //select * from posts where id = 1 limit 1;

        $postCollection = Post::where('id', $id)->get(); //Collection object .... select * from posts where id = 1;

        $post = Post::where('id', $id)->first(); //Post model object ... select * from posts where id = 1 limit 1;

        //        Post::where('title', 'Laravel')->first();

        return view('post.show', ['post' => $post]);
    }


    ///////////////////////////////////Edit/////////////////////////////
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        return view('post.edit', ['users' => $users], ['post' => $post]);
    }
    public function update(Request $request, $id){
        $post = post::find($id);
        $post->update(
            [
                //column name -> came data of name of input
               'title'=> request()->title,
               'description'=> request()->description,


            ]);
        return to_route('posts.index')->with('success', 'A Post is Updated Successfully!');
    }

    // public function update($post, Request $request)
    // {
    //     $singlePost = Post::findOrFail($post);
    //     $singlePost->update([
    //         'title'=>$request->title,
    //         'description'=>$request->description,
    //     ]);

    //     dd($singlePost);
    // }





    //CREATE function
    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }

    public function store(Request $request){
        //  $data = request()->all();
        //  dd($data);
        // //store data in variables
          $title = request()->title;
          $description = request()->description;
          $userCreator = request()->post_creator;

        //store variables data in database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userCreator,
        ]);
        return to_route('posts.index');
    }

    //delete
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();
        return redirect()->route('posts.index', $post['user_id']);
    }
}
