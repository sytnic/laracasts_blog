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

})->where('post', '[A-z_\-]+')  ;  // whereAlpha('post');
