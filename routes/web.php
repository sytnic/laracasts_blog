<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

       return view('posts');
    // return view('welcome');
    // return [ "foo" => "bar"];
    // return 'Hello world';
});

Route::get('posts/{post}', function ($slug) {

    // Find a post by its slug and pass it to a view called "post"
    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]);

    // чтобы только такие посты отрабатывали в адресной строке, 
    // с остальными символами - 404
})->where('post', '[A-z_\-]+') ;  // whereAlpha('post');

/*
// Wildcard {post}:
// пример того, как на страницу возвращается 
// свой собственный url {post},
// вбитый в адресную строку вручную

Route::get('posts/{post}', function ($slug) {
    return $slug;
});
*/