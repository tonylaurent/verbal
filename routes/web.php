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

Auth::routes();

Route::get('/', function () {
    return view('theme.home', [
        'posts' => App\Post::orderBy('id', 'desc')->get()
    ]);
})->name('home');

Route::get('/posts/{post}', function (App\Post $post) {
    return view('theme.post-show', [
        'post' => $post
    ]);
})->name('post.show');

Route::get('/categories/{category}/posts', function (App\Category $category) {
    return view('theme.post-list', [
        'posts' => $category->posts()->orderBy('id', 'desc')->get()
    ]);
})->name('category.post');

