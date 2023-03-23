<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all(); //select * from posts

        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
//        $post = Post::find($id); //select * from posts where id = 1 limit 1;

        $postCollection = Post::where('id', $id)->get(); //Collection object .... select * from posts where id = 1;

        $post = Post::where('id', $id)->first(); //Post model object ... select * from posts where id = 1 limit 1;

//        Post::where('title', 'Laravel')->first();

        return view('post.show', ['post' => $post]);
    }

//     public function show($id)
//     {
// //        dd($id);
//         $post =  [
//             'id' => 3,
//             'title' => 'Javascript',
//             'posted_by' => 'Ali',
//             'created_at' => '2022-08-01 10:00:00',
//             'description' => 'hello description',
//         ];

// //        dd($post);

//         return view('post.show', ['post' => $post]);
//     }

    //EDIT function
                              ////////Edit////////
                              public function edit($post){
                                $post= Post::find($post);
                                $users = User::all();
                                return view('posts.edit', ['users' => $users], ['post' => $post]);
                            }
                              public function update(Request $request, $id)
                              {
                                  $post = Post::find($id);

                                  $post->title = $request->input('title');
                                  $post->description = $request->input('description');
                                  $post->save();

                                  return redirect()->route('posts.index');
                              }



    //CREATE function
    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        //get the form data
//        $data = request()->all();
//
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

//        $data = $request->all();

        //insert the form data in the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        //redirect to index route
        return to_route('posts.index');
    }
}
