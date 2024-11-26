@extends('layouts.app')
@section('title')
    BLogER | Postlar
@endsection
@section('content')
    <div class="col-span-3">
        @if (Auth::check() && $user->hasVerifiedEmail())
            {{-- post name || create --}}
            <div class="flex items-center justify-between mb-4  ">
                <h1 class="font-medium text-xl lg:text-2xl text-slate-900 dark:text-white">
                    {{ __('Postlar') }}
                </h1>
                <a class="flex items-center gap-1 px-2.5 py-1.5 text-sm lg:text-base rounded bg-blue-500 text-white hover:bg-blue-400 dark:hover:bg-blue-600"
                    href="{{ route('post.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Yeni Post') }}
                </a>
            </div>
            <hr class="mb-6">
            @forelse ($posts as $post)
                <div class="max-w-6xl bg-slate-100 dark:bg-gray-800  p-4 rounded mb-6">
                    <div class="flex flex-col lg:flex-row  justify-between ">
                        <a class="lg:w-1/4"
                            href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}">
                            <img class="w-full mb-4 h-56 object-cover rounded-md  "
                                src="{{ asset('assets/image/post/' . $post->image) }}" alt="">
                        </a>
                        <div class="flex flex-col justify-between lg:w-3/4 w-full lg:px-4 lg:h-56">
                            <div>
                                {{-- content --}}
                                <div class="flex  justify-between  items-center  mb-4">
                                    <div class="w-3/4">
                                        <a href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}"
                                            class="font-medium text-sm lg:text-base hover:underline text-slate-900 dark:text-white">{{ Str::title($post->title) }}</a>
                                    </div>
                                    <div class="w-1/4 lg:text-end">
                                        <a href="{{ route('kategoriler.index', ['category' => $post->category->title]) }}"
                                            class=" hover:underline  font-light text-sm lg:text-base text-slate-900 dark:text-white">{{ Str::title($post->category->title) }}</a>
                                    </div>
                                </div>
                                <div class="mb-4 ">
                                    <p class="text-sm lg:text-base  text-slate-900 dark:text-white">
                                        {{ Str::limit($post->content, 400) }}
                                    </p>
                                </div>
                            </div>
                            <div class="lg:text-end text-sm lg:text-base text-slate-900 dark:text-white">
                                <a class="me-2 hover:text-blue-500 hover:underline"
                                    href="{{ route('kategoriler.post.show', ['kategoriler' => $post->category->title, 'post' => $post->title]) }}">{{ __('Görüntüle') }}</a>
                                <a class="me-2 hover:text-green-500 hover:underline"
                                    href="{{ route('post.edit', $post->title) }}">{{ __('Düzenle') }}</a>
                                <button data-modal-target="post-delete-modal" data-modal-toggle="post-delete-modal"
                                    type="button" class="hover:text-red-500 hover:underline">
                                    {{ __('Sil') }}
                                </button>

                                <!-- Modal -->
                                <div id="post-delete-modal" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                            <div class="p-4 md:p-5 text-center">
                                                <form action="{{ route('post.delete', $post) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        {{ __('Postu silmek istediğine emin misin? ') }}</h3>
                                                    <p class="text-sm md:text-base mb-4 text-slate-900 dark:text-white">
                                                        {{ __('Post silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir.') }}
                                                    </p>
                                                    <button data-modal-hide="post-delete-modal" type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        {{ __('Postu Sil') }}
                                                    </button>
                                                    <button data-modal-hide="post-delete-modal" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        {{ __('İptal Et') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-slate-100 dark:bg-gray-800 py-16 px-2  text-center">
                    <div>
                        <h1 class="text-lg mb-4 text-slate-900 dark:text-white">
                            {{ __('Yayında olan bir yazınız bulunmamaktadır.') }}
                        </h1>
                        <span class="font-medium text-base text-slate-900 dark:text-white">
                            {{ __('Yazı paylaşmak için') }} <a href="{{ route('post.create') }}"
                                class="text-blue-500 hover:underline ">tıklayınız.</a>
                        </span>
                    </div>

                </div>
            @endforelse
        @else
            <div class="bg-slate-100 dark:bg-gray-800 py-16 px-2  text-center">
                <div>
                    <h1 class="text-lg mb-4 text-slate-900 dark:text-white">
                        {{ __('Paylaşım oluşturmak, görüntülemek ve düzenlemek için lütfen e-posta adresinizi doğrulayın.') }}
                    </h1>
                    <span class="font-medium text-base text-slate-900 dark:text-white">
                        {{ __('E-posta adresinizi doğrulamak için') }} <a href="{{ route('profile.edit') }}"
                            class="text-blue-500 hover:underline ">tıklayınız.</a>
                    </span>
                </div>

            </div>
        @endif
    </div>
    <script>
        const openModalBtn = document.querySelector(
            '[data-modal-target="post-delete-modal"]'
        );
        const closeModalBtn = document.querySelectorAll(
            '[data-modal-hide="post-delete-modal"]'
        );
        const Postmodal = document.getElementById("post-delete-modal");

        openModalBtn.addEventListener("click", () => {
            Postmodal.classList.remove("hidden");
            Postmodal.classList.add("flex");
            document.body.style.overflow = "hidden";
        });

        // Close modal when close button is clicked
        closeModalBtn.forEach((button) => {
            button.addEventListener("click", () => {
                Postmodal.classList.add("hidden"); // Hide modal
                Postmodal.classList.remove("flex"); // Reset flex display
                document.body.style.overflow = "auto"; // Re-enable scrolling
            });
        });

        // Optional: Close modal if clicked outside of the modal content (on the overlay)
        Postmodal.addEventListener("click", (event) => {
            if (event.target === Postmodal) {
                Postmodal.classList.add("hidden");
                Postmodal.classList.remove("flex");
                document.body.style.overflow = "auto";
            }
        });
    </script>

@endsection
