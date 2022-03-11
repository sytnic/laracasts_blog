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
Route::get('posts/{post}', function ($slug) {    

    $path = __DIR__."/../resources/posts/{$slug}.html";

    if(! file_exists($path)){
        //ddd("file does not exist");
        //abort(404);
        return redirect('/');
    }

    $post = file_get_contents($path);

    return view('post', [
            'post' => $post
            //'post' => '<h3>Hello world</h3>' // $post
        ]
    );

});
*/
// Предварительная версия 3
// $slug передаётся в file_get_contents и $post
// работает так: /posts/my-first-post
Route::get('posts/{post}', function($slug) {         // какой get использовать
       
    $post = file_get_contents(__DIR__."/../resources/posts/{$slug}.html"); // что значит переменная $post
    
    return view('post', [               // какой view загружать
        'post' => $post                 // передана переменная $post в этот view
        //'post' => '<h3>Hello world</h3>'
    ]);
    

});