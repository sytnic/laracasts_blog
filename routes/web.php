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

        $posts = Post::all();

        // dd($posts);
        // dd($posts[0]);
        // dd($posts[0]->getPathname());
        // dd( (string) $posts[0] );

        // dd($posts[2]->getContents());

        return view('posts', [
           'posts' => $posts
        ]    
    );
    // return view('welcome');
    // return [ "foo" => "bar"];
    // return 'Hello world';
});


// {post} и $slug формируют автоматический возврат слага из адресной строки

Route::get('posts/{post}', function ($slug) {   // какой url и метод (get)

    // Find a post by its slug and pass it to a view called "post".
    // Найти post по его слагу и передать его во view под названием "post".
    $post = Post::find($slug);                  // какие модель и метод задействуются

    return view('post', [                       // какой view
        'post' => $post                         // какая переменная передаётся во view
    ]);

    // чтобы только такие посты отрабатывали в адресной строке, 
    // с остальными символами - 404
})->where('post', '[A-z_\-]+') ;  // whereAlpha('post');

