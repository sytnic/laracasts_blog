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

    if(! file_exists($path)) {
        //ddd("file does not exist");
        //abort(404);
        return redirect('/');
    }

    // кэширование контента для get-запроса
    // в секундах (integer) или с помощью функции now()->addMinutes(20)
    
    $post = cache()->remember("posts.{$slug}", 1200, function() use($path) {
        var_dump('file_get_contents');
        return file_get_contents($path);
      }
    );  
    
    // короткая версия    
    //$post = cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

    return view('post', [
            'post' => $post
            //'post' => '<h3>Hello world</h3>' // $post
        ]        
    );
// чтобы только такие посты отрабатывали в адресной строке, 
// с остальными символами - 404
})->where('post', '[A-z_\-]+')  ;  // whereAlpha('post');
