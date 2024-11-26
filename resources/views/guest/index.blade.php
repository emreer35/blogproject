@extends('layouts.app')
@section('title')
    BlogER | Home
@endsection
@section('content')
    <div class="col-span-2  dark:border-gray-800 rounded-md ">

        @foreach ($latestPosts as $post)
            <div class="p-4 mb-4 rounded bg-slate-100 dark:bg-gray-800 dark:text-white ">

                {{-- blog image --}}
                <a
                    href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}">
                    <img src="{{ asset('assets/image/post/' . $post->image) }}"
                        class="h-52 w-full object-cover mb-4 rounded-t-md" alt="">
                </a>
                {{-- blog content --}}
                <div class="">
                    <div class="flex items-start justify-between mb-4">
                        <a href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}"
                            class="font-medium text-lg lg:text-xl hover:underline">"{{ Str::title($post->title) }}"</a>
                        <div class="flex items-center">
                            <img class="h-7 " src="{{ asset('assets/image/user/' . $post->user->image) }}" alt="">
                            <span class="ms-3 font-medium text-sm">{{ Str::title($post->user->name) }}</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        {{ Str::limit($post->content, 150) }}
                    </div>
                </div>

            </div>
        @endforeach

    </div>
    <div class="col-span-1  rounded-md p-4 bg-slate-100 dark:bg-gray-800 self-start hidden lg:block ">
        <div class="font-medium text-base mb-2 dark:text-white">
            {{ Str::title('other blogs') }}
        </div>
        <hr class="mb-2 h-0.5 border-t-0 bg-neutral-200 dark:bg-white/10" />

        @foreach ($posts as $post)
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <img class="h-5" src="{{ asset('assets/image/user/' . $post->user->image) }}" alt="user_photo">
                    <span class="text-xs dark:text-white">{{ Str::title($post->user->name) }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-medium dark:text-white">{{ $post->title }}</span>
                    <div class="dark:text-white">
                        {{ Str::limit($post->content, 75) }}
                    </div>
                    <span class="block">
                        <a href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}"
                            class="text-xs font-medium text-slate-400 hover:text-slate-700 dark:hover:text-slate-300">
                            Read More...
                        </a>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
