<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

    $files = File::files(resource_path("posts/"));
    $documents = [];

    foreach ($files as $file){
        $documents[] = YamlFrontMatter::parseFile($file);
    }

    dd($documents);

    /*
    // пример работы YamlFrontMatter   

    $document = YamlFrontMatter::parseFile (resource_path('posts/my-fourth-post.html'));

    dd($document);
    //dd($document->body());
    //dd($document->matter());
    //dd($document->matter('title'));
    //dd($document->title);
    //dd($document->excerpt);
    //dd($document->date);
    */
        // $posts = Post::all(); // array

        // dd($posts);
        // dd($posts[0]);
        // dd($posts[0]->getPathname());
        // dd( (string) $posts[0] );

        // dd($posts[2]->getContents());

        return view('posts', [   // вызывается вью
           // 'posts' => 
           'myposts' => $posts  // в ключе передаётся переменная для вью
                             // в значении передаётся переменная для ключа
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

