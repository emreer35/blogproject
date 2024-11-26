<?php

use App\Models\Post;

function posts(){
    return Post::with(['user','category'])->inRandomOrder()->take(13)->get();
}