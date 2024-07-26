<?php

namespace App\Models;

use Exception;
use Faker\Core\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public static function all()
    {
        $files = \Illuminate\Support\Facades\File::files(resource_path("posts/"));
//        $files = File::files(resource_path("posts/"));
        return array_map(fn($file) => $file -> getContents(), $files);
    }

    /**
     * @throws Exception
     */
    public static function find($slug)
    {
        if (!file_exists($path = resource_path("posts/$slug.html"))) {
//            throw new ModelNotFoundException();
            return view('404');
        }

    return cache()->remember("posts.$slug", 1200, fn() => file_get_contents($path));
    }
}
