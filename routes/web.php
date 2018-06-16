<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = App\Post::orderBy('datetime', 'desc')
        ->take(5)
        ->get();
    
    return view('theme::home', [
        'posts' => $posts
    ]);
})->name('home');

Route::get('/posts/{post}', function (App\Post $post) {
    return view('theme::post-show', [
        'post' => $post
    ]);
})->name('post.show');

Route::get('/tags/{tag}/posts', function (App\Tag $tag) {
    $posts = $tag
        ->posts()
        ->orderBy('datetime', 'desc')
        ->simplePaginate(10);
    
    return view('theme::post-list', [
        'posts' => $posts 
    ]);
})->name('tag.post');

