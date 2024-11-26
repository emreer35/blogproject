<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Category $category)
    {
        $posts = Post::with(['user', 'category'])->where('user_id', $request->user()->id)->latest()->get();


        return view('post.index', [
            'user' => $request->user(),
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creati ng a new resource.
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Post::class);

        return view('post.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $request->validated();


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $fileDIR = 'assets/image/post/';
            $file->move(public_path($fileDIR), $fileName);
        }
        $post = new Post();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $fileName;
        $post->user_id = $request->user()->id;
        $post->published_at = now();
        $post->save();


        return redirect()->route('post.index')->with('success', 'Post Başarıyla Oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $kategoriler, Post $post)
    {

        $posts = Cache::remember('random_post', 60 * 60 * 24, function () {
            $post = posts();
            return $post;
        });
        $post = Post::with('category')->where('id', $post->id)->commentCount()->first();
        $postUrl = route('kategoriler.post.show', ['kategoriler' => $kategoriler->title, 'post' => $post->title]);

        $randomTakePost = Post::with('category')->where('category_id', $kategoriler->id)->where('id', '!=', $post->id)->get();
        // Tekil Postu Alırken first() veya findOrFail() Kullanın: 
        // Eğer yalnızca tek bir post alacaksanız, first() veya findOrFail() 
        // gibi bir yöntem kullanarak doğrudan bir Post nesnesi döndürdüğünden emin olun.


        // tek bir post alirken where kullaniyorsan first i kullan yada
        // $post = Post::with(['comments.user'])->findOrFail($post->id);
        //yada
        // $post = Post::with(['comments.user'])->find($post->id);
        $postComments = Post::with(['comments' => function ($query) {
            $query->latest();
        }, 'comments.user'])->where('id', $post->id)->first();

        return view('post.show', [
            'posts' => $posts,
            'postUrl' => $postUrl,
            'post' => $post,
            'category' => $kategoriler,
            'randomTakePost' => $randomTakePost,
            'postComments' => $postComments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $post::with(['category'])->first();
        return view('post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        Gate::authorize('update',  $post);
        $request->validated();
        $fileName = $post->image;

        if ($request->hasFile('file')) {
            if (!empty($post->image) && File::exists(public_path('assets/image/post/' . $post->image))) {
                File::delete(public_path('assets/image/post/' . $post->image));
            }

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/images/post/';
            $file->move(public_path($filePath), $fileName);
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $fileName;
        $post->category_id = $request->category_id;
        $post->published_at = now();
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('update',  $post);
        $postImage = 'assets/image/post/' . $post->image;
        if (File::exists(public_path($postImage))) {
            File::delete(public_path($postImage));
        }
        $post->delete();

        return back()->with('success', 'Post Başarıyla Silindi');
    }
}
