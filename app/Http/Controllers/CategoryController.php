<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $posts = Cache::remember('random_post', 60 * 60 * 24, function () {
            $post = posts();
            return $post;
        });

        $category = $request->query('category');
        $categoryData = Category::where('title', $category)->first();

        $categoryTitle = Category::where('title', $category)->first();
        $categories = Cache::remember('random_categoryPost', 60 * 60 * 24, function () {
            return Category::randomPosts()->get();
        });

        $filterCategory = Post::when($categoryData, function ($query) use ($categoryData) {
            $query->where('category_id', $categoryData->id);
        })->with('category')->latest()->get();
        return view('categories.index', [
            'posts' => $posts,
            'filterCategory' => $filterCategory,
            'categories' => $categories,
            'categoryTitle' => $categoryTitle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
