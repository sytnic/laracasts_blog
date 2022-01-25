<?php

namespace App\Models;

class Post 
{
    public static function find($slug){

        // использование путей с помощью функций laravel
        //base_path();
        //app_path();
        //resource_path();


        if(! file_exists ($path = resource_path("posts/{$slug}.html"))) {
            //ddd("file does not exist");
            //abort(404);
            return redirect('/');
        }

        // кэширование контента для get-запроса
        // в секундах (integer) или с помощью функции now()->addMinutes(20)
        // длинная версия
    
        // $post = cache()->remember("posts.{$slug}", 1200, function() use($path){
        //     var_dump('file_get_contents');
        //     return file_get_contents($path);
        // }
        // );  
    
        // короткая версия
        return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
        
    }
}