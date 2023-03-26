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

        $post = Post::where('id', $id)->first();
        $comments = $post->comments;
        //dd($);
        return view('post.show',["comments"=>$comments,'post' => $post]);
    }


    ///////////////////////////////////Edit/////////////////////////////
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        return view('post.edit', ['users' => $users, 'post' => $post]);
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




    //CREATE function
    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }

    public function store(StorePostRequest $request){  //logic of inserting data in database
        //validation on the data form
        // $request->validate([ //take key and value
        //     'title' => ['required' , 'min:3'],
        //     'description' => ['required' , 'min:3'],

        // ]);


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
