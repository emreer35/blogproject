@extends('layouts.app')
@section('title')
    BlogER | {{ $post->title }}
@endsection

@section('metatag')
    <meta property="og:url" content="{{ urlencode($postUrl) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ urlencode($post->title) }}" />
    <meta property="og:description" content="{{ Str::limit($post->content, 100) }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="twitter:card" content="summary_large_image" />

    <style>
        /* Genel yapı */
        .carousel-container {
            max-width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .carousel-list {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            flex-shrink: 0;
            width: 80%;
            margin-right: 20px;
            text-align: center;
        }

        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
        }

        .carousel-button-prev {
            left: 10px;
        }

        .carousel-button-next {
            right: 10px;
        }
    </style>
@endsection

@section('content')
    <div id="copyMessage"
        class="absolute z-30 top-20 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white dark:bg-white dark:text-slate-900 p-3 rounded-sm shadow-md opacity-0 translate-y-[-100%] transition-all duration-500 w-96 text-sm ">
        Link kopyalandı!
    </div>
    <div class="col-span-3 p-4  bg-slate-100 dark:bg-gray-800 self-start rounded-md mb-4 ">
        <div class="mx-auto xl:w-3/5 lg:w-3/5">
            <div class="mb-4 md:mb-8 lg:mb-12 font-bold text-xl md:text-2xl lg:text-5xl text-slate-900 dark:text-white">
                {{ Str::title($post->title) }}</div>
            <div class="flex items-center justify-between mb-4">
                {{-- author --}}
                <div class="flex items-center mb-4">

                    <img src="{{ asset('assets/image/user/' . $post->user->image) }}" class="h-10 object-cover me-4"
                        alt="user_image">
                    <div class="">
                        <span class="block font-medium text-slate-900 dark:text-white">
                            {{ Str::title($post->user->name) }}
                        </span>
                        <span class="font-light text-base text-slate-900 dark:text-white">
                            {{ $post->published_at->format('M d, Y H:i') }}
                        </span>
                    </div>
                </div>
                @can('update', $post)
                    <div class="">
                        <a class="px-2.5 py-1.5 bg-blue-500 rounded-md text-white dark:bg-blue-500 dark:hover:bg-blue-600 hover:bg-blue-400 transition-all duration-75 "
                            href="{{ route('post.edit',$post) }}">Düzenle</a>
                    </div>
                @endcan
            </div>
            <hr>
            {{-- user comment count --}}
            <div class="flex items-center justify-between ">
                <div class="flex items-center px-2 py-3" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="currentColor" class="dark:text-white" class="rk">
                        <path
                            d="M18.006 16.803c1.533-1.456 2.234-3.325 2.234-5.321C20.24 7.357 16.709 4 12.191 4S4 7.357 4 11.482c0 4.126 3.674 7.482 8.191 7.482.817 0 1.622-.111 2.393-.327.231.2.48.391.744.559 1.06.693 2.203 1.044 3.399 1.044.224-.008.4-.112.486-.287a.49.49 0 0 0-.042-.518c-.495-.67-.845-1.364-1.04-2.057a4 4 0 0 1-.125-.598zm-3.122 1.055-.067-.223-.315.096a8 8 0 0 1-2.311.338c-4.023 0-7.292-2.955-7.292-6.587 0-3.633 3.269-6.588 7.292-6.588 4.014 0 7.112 2.958 7.112 6.593 0 1.794-.608 3.469-2.027 4.72l-.195.168v.255c0 .056 0 .151.016.295.025.231.081.478.154.733.154.558.398 1.117.722 1.659a5.3 5.3 0 0 1-2.165-.845c-.276-.176-.714-.383-.941-.59z">
                        </path>
                    </svg>
                    <span class="font-medium text-slate-900 dark:text-white">{{ $post->comments_count }}</span>
                </div>
                <div>


                    <div class="flex items-center ms-3 relative">
                        <button type="button" class="dark:text-white" aria-expanded="false"
                            data-dropdown-toggle="dropdown-share">
                            <span class="sr-only">Open share menu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24"
                                fill="currentColor">
                                <path
                                    d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z" />
                            </svg>
                        </button>

                        <div class="z-50 hidden absolute right-0 top-full mt-2 w-48 bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-share">
                            <div class="" role="none">
                                <button type="button" id="copyBtn"
                                    class=" w-full flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="none">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24"
                                        class="" fill="currentColor" height="24">
                                        <path
                                            d="M384 336l-192 0c-8.8 0-16-7.2-16-16l0-256c0-8.8 7.2-16 16-16l140.1 0L400 115.9 400 320c0 8.8-7.2 16-16 16zM192 384l192 0c35.3 0 64-28.7 64-64l0-204.1c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1L192 0c-35.3 0-64 28.7-64 64l0 256c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l192 0c35.3 0 64-28.7 64-64l0-32-48 0 0 32c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256c0-8.8 7.2-16 16-16l32 0 0-48-32 0z" />
                                    </svg>
                                    Link'i Kopyala
                                </button>
                                <input id="linkUrl" type="text" value="{{ url($postUrl) }}" class="absolute"
                                    style="left: -9999px;">

                            </div>
                            <ul class="py-1" role="none">
                                <li class=""><a
                                        href="https://twitter.com/intent/tweet?url={{ urlencode($postUrl) }}&text={{ urlencode($post->title) }}"
                                        target="_blank"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 448 512">
                                            <path
                                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z" />
                                        </svg> X'te Paylaş!</a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url($postUrl)) }}"
                                        target="_blank"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 512 512">
                                            <path
                                                d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                                        </svg>Facebook'ta Paylaş!</a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url($postUrl)) }}&title={{ urlencode($post->title) }}"
                                        target="_blank"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor"
                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                        </svg>LinkedIn'da Paylaş!</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- <div>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($postUrl) }}&text={{ urlencode($post->title) }}"
                    target="_blank">Twitter'da Paylaş</a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($postUrl) }}" target="_blank">
                    WhatsApp'ta Paylaş
                </a>
            </div> --}}

            <div class="flex justify-center my-4 md:mb-8 lg:mb-12">
                <img class="w-full object-cover" src="{{ asset('assets/image/post/' . $post->image) }}" alt="">
            </div>

            <div class="mb-4 md:mb-8 lg:mb-12 first-letter:ms-5 text-slate-900 dark:text-white ">

                {!! nl2br(e($post->content)) !!}
            </div>

            <h1 class="mb-4 md:mb-8 text-2xl font-medium text-slate-900 dark:text-white">"İlginizi Çekebilir..."
                <hr class="mt-3">
            </h1>



            <div class="relative max-w-7xl mx-auto overflow-hidden mb-4 md:mb-8 lg:mb-12">
                <ul id="carousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($randomTakePost as $rtpost)
                        <li class="carousel-item flex-shrink-0 w-full md:w-2/5 mx-2 text-center">
                            <a
                                href="{{ route('kategoriler.post.show', ['kategoriler' => $rtpost->category->title, 'post' => $rtpost->title]) }}">
                                <img src="{{ $rtpost->image }}" alt="post_image"
                                    class="w-full h-60 object-cover rounded-lg">
                                <span
                                    class="block mt-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $rtpost->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Sol ve sağ oklar -->
                <button id="prev"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 w-12 h-12 bg-gray-600 text-white rounded-full opacity-75 hover:opacity-100 transition-opacity">
                    &#10094;
                </button>
                <button id="next"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 w-12 h-12 bg-gray-600 text-white rounded-full opacity-75 hover:opacity-100 transition-opacity">
                    &#10095;
                </button>
            </div>


            <div class="">
                <div class="text-end">
                    <button type="button" data-modal-target="comment-modal" data-modal-toggle="comment-modal"
                        class=" text-white bg-gray-900 text-sm rounded-md px-2.5 py-1.5 mb-4 border border-transparent hover:bg-white hover:border-gray-900 hover:text-gray-900 dark:text-slate-900 dark:bg-white dark:hover:bg-transparent dark:hover:text-white dark:hover:border dark:hover:border-white transition-all duration-100 font-medium ">
                        {{ __('Yorum Yaz') }}
                    </button>
                </div>

                {{-- Command modal --}}
                <div id="comment-modal" tabindex="-1" aria-hidden="true"
                    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50 dark:bg-gray-800 dark:bg-opacity-75">
                    <div class="relative p-4 w-full max-w-md">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 text-slate-900 dark:text-white">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold">
                                    {{ $post->title }}
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-md p-2 text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="comment-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-2" method="POST" id="commentForm"
                                    action="{{ route('kategoriler.post.comment.store', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <label for="content" class="block mb-2 text-sm font-medium">Yorumunuz</label>
                                        <textarea type="text" name="content" id="content"
                                            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required> </textarea>
                                    </div>
                                    @if ($errors->has('content'))
                                        <div class="text-red-600 dark:text-red-400 font-light text-sm py-1.5 mt-0">
                                            {{ $errors->first('content') }}
                                        </div>
                                    @endif
                                    <button
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Paylaş
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @forelse ($postComments->comments as $comment)
                <div
                    class="flex flex-col md:flex-row items-start p-4 mb-4 rounded-lg shadow-lg w-full  mx-auto bg-white dark:bg-gray-600 ">
                    <div
                        class="flex flex-col items-center  w-full md:w-1/4 text-center md:text-left border-b-2 md:border-b-0 md:border-r-2 pb-4 md:pb-0 md:pr-4">
                        <img class="h-16 w-16 rounded-full border-2 border-gray-300 mb-2"
                            src="{{ asset('assets/image/user/' . $comment->user->image) }}" alt="user_image">
                        <span
                            class="text-md font-semibold text-slate-900 dark:text-white ">{{ $comment->user->name }}</span>

                        <span
                            class="text-center text-base font-light text-slate-900 dark:text-white ">{{ $comment->published_at->format('M d, Y H:i') }}</span>
                    </div>

                    <!-- Yorum Metni -->
                    <div
                        class="w-full md:w-3/4 mt-4 md:mt-0 md:pl-4 text-slate-900 dark:text-white text-sm leading-relaxed">
                        {{ $comment->content }}
                    </div>
                </div>
            @empty
                <div class="text-center p-4 mb-4 rounded-lg shadow-lg w-full  mx-auto bg-white dark:bg-gray-600 ">
                    <p class="text-md font-semibold text-slate-900 dark:text-white">İlk yorumu siz atın.</p>

                    <button type="button" data-modal-target="comment-modal" data-modal-toggle="comment-modal"
                        class="text-md font-light text-slate-900 dark:text-white hover:text-blue-700 hover:underline dark:hover:text-blue-300">
                        Yorum yapmak için tıklayınız.
                    </button>
                </div>
            @endforelse


        </div>
    @endsection
    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (@json($errors->has('content'))) {
                    const commentModal = document.getElementById('comment-modal');
                    commentModal.classList.remove('hidden');
                }
            })
        </script>
    @endsection
