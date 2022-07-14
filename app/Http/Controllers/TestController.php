<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function __invoke()
    {
        // $post = Post::with('user')->first();
        // dd($post);

        $raw = array_add([
            'publish' => 'PUBLISH',
            'article' => 'ARTICLE',
            'article' => 'ARTICLE',
        ], [
            'publish' => 'PUBLISH',
            'article' => 'ARTICLE',
            'new'     => 'NEW',
        ]);

        $data = array_unique($raw);
        dd($data);
    }
}
