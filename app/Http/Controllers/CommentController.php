<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $kategoriler, Post $post)
    {
        $data = $request->all();
        $rules = [
            'content' => 'required|min:10|string'
        ];
        $messages = [
            'content.required' => 'Lütfen yorum alanını doldurunuz.',
            'content.min' => 'Minimum 10 karakter kullanınız.',
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
        ]);

        return redirect()->route('kategoriler.post.show', ['kategoriler' => $kategoriler->title, 'post' => $post->title])->with([
            'success' => 'Yorumunuz Başarıyla Eklendi.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
