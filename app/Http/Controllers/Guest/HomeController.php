<?php

namespace App\Http\Controllers\Guest;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::with(['posts' => function ($query) {
        //     $query->latest()->take(7);
        // }])->get();
        $posts = Cache::remember('random_post', 60 * 60 * 24, function () {
            // return Post::with('user')->latest()->inRandomOrder()->take(13)->get();
            $post = posts();
            return $post;
        });

        $latestPosts = Cache::remember('latest_posts', 60 * 60 * 24, function () {
            return Post::with(['user','category'])->latest()->take(25)->get();
        });
        return view('guest.index', [
            // 'categories' => $categories,
            'posts' => $posts,
            'latestPosts' => $latestPosts
        ]);
    }
}
