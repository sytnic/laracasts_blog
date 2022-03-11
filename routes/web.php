<?php

use Illuminate\Support\Facades\Route;

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

/* Окончательная версия
*/

// $slug передаётся в file_get_contents и $post
// работает так: /posts/my-first-post
Route::get('posts/{post}', function($slug) {         // какой get использовать
       
    $path = __DIR__."/../resources/posts/{$slug}.html";

    // если путь в слаге указан неверно     
    if(! file_exists($path)){
        // Варианты использования:

        // dd("file does not exist");
        // ddd("file does not exist");
        // abort(404);
        return redirect('/');
    }

    $post = file_get_contents($path); // что значит переменная $post    

    return view('post', [               // какой view загружать
        'post' => $post                 // передана переменная $post в этот view
        //'post' => '<h3>Hello world</h3>'
    ]);
    

});