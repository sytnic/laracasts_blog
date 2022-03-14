<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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

            //return redirect('/');
            
            // использование исключения вместо редиректа, появляется 404.
            // throw new \Exception;
            // или
            throw new ModelNotFoundException();

        }

        // кэширование контента для get-запроса
        // в секундах (integer) или с помощью функции now()->addMinutes(20) или 
        // now()->addHour(), now()->addDay(), now()->addDays(),  
        
        // длинная версия    
        // $post = cache()->remember("posts.{$slug}", 1200, function() use($path){
        //     var_dump('file_get_contents');
        //     return file_get_contents($path);
        // }
        // );  
    
        // короткая версия
        return cache()->remember("posts.{$slug}", 10, fn() => file_get_contents($path));
        
    }
}