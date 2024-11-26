@extends('layouts.app')
@section('title')
    BlogER | {{ isset($categoryTitle) ? $categoryTitle->title : 'Kategoriler' }}
@endsection
@section('content')
    <div class="col-span-2 dark:border-gray-800  rounded-md mb-4">
        {{-- filter --}}
        {{-- categories --}}
        <div class="flex items-center flex-wrap">
            <a class="text-gray-900 border border-slate-400 dark:border-none {{ !request('category') ? 'bg-gray-200 dark:bg-gray-600' : 'border-slate-400' }} rounded-lg dark:text-white hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 px-2.5 py-1.5 me-3  mb-3"
                href="{{ route('kategoriler.index') }}">Tümünü Görüntüle</a>
            @foreach ($categories as $category)
                <a class="text-gray-900 border {{ request('category') == $category->title ? 'bg-gray-200 dark:bg-gray-600' : 'border-slate-400' }} border-slate-400 dark:border-none rounded-lg dark:text-white hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 px-2.5 py-1.5 me-3 mb-3 "
                    href="{{ route('kategoriler.index', ['category' => $category->title]) }}">{{ $category->title }}</a>
            @endforeach
        </div>


        @forelse ($filterCategory as $post)
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
                            <img class="h-7 " src="{{ asset('assets/image/user/' . $post->user->image) }}"
                                alt="">
                            <span class="ms-3 font-medium text-sm">{{ Str::title($post->user->name) }}</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        {{ Str::limit($post->content, 150) }}
                    </div>
                </div>
            </div>
        @empty
            <div class=" text-center  py-8 ">
                <span class="block text-gray-900 dark:text-white">Bu kategoride hiç blog bulunmamaktadır.</span>
                <span class="text-gray-900 dark:text-white">Tüm kategoriler için
                    <a class=" font-medium text-blue-400 hover:text-slate-700 dark:hover:text-slate-300"
                        href="{{ route('kategoriler.index') }}">
                        tıklayınız.
                    </a>
                </span>
            </div>
        @endforelse



    </div>

    <div class="col-span-1  rounded-md p-4 bg-slate-100 dark:bg-gray-800 self-start hidden lg:block ">
        <div class="font-medium text-base mb-2 dark:text-white">
            {{ Str::title('other blogs') }}
        </div>
        <hr class="mb-2 h-0.5 border-t-0 bg-neutral-200 dark:bg-white/10" />

        @foreach ($posts as $post)
            <div>
                <div class="flex  items-center gap-2 mb-2">
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
