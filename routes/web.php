<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TestController::class, 'test']);

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
// Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Auth::routes();
Route::get('/posts',[PostController::class, 'index'])->name('posts.index')->middleware(middleware:'auth');
Route::get("/posts/removeold",[PostController::class,"removeOldPosts"]);
Route::group(['middleware'=>['auth']],function(){
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::get('/posts/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

//Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
//Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
