@extends('layouts.app')
@section('title')
    BlogER | {{ $post->title }} Düzenle
@endsection
@section('content')
    <div class="col-span-3">
        <h1 class="text-lg font-medium lg:text-2xl mb-4 text-slate-900 dark:text-white">{{ __('Post Düzenle') }}</h1>
        <hr class="mb-4">
        <div class="dark:bg-gray-800 py-6 px-2">
            <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex items-center justify-center w-full mb-4">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full lg:w-3/4 p-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <img id="uploadedImage"
                            class="w-full h-56 lg:h-72 object-cover rounded {{ $post->image ? '' : 'hidden' }}"
                            src="{{ $post->image ? asset('assets/image/post/' . $post->image) : '' }}" alt="Uploaded Image">
                        <div id="uploadArea" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg id="uploadIcon" class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p id="uploadMessage"
                                class="mb-2 text-sm text-gray-500 dark:text-gray-400 {{ $post->image ? 'hidden' : '' }}">
                                Yüklemek için <span class="font-semibold">sürükleyin ya da tıklayın</span>
                            </p>
                            <p id="againuploadMessage"
                                class="text-sm text-gray-500 dark:text-gray-400 {{ $post->image ? '' : 'hidden' }}">
                                Değiştirmek için <span class="font-semibold">tıklayınız</span>
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" name="file" />
                    </label>
                </div>
                @error('file')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror
                <div>
                    <select id="category_id" name="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full lg:max-w-screen-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Kategori Seç</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <input
                        class="outline-none w-full px-2 py-1.5 font-medium text-lg lg:text-2xl dark:bg-gray-800 dark:text-white"
                        type="text" name="title" id="title" value="{{ $post->title }}" placeholder="Başlık">
                    @error('title')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                    <textarea id="autoResizeTextarea"
                        class="outline-none w-full px-2 py-1.5 text-base lg:text-lg dark:bg-gray-800 dark:text-white" name="content"
                        placeholder="İçerik..." rows="6">{{ $post->content }}</textarea>
                    @error('content')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                </div>

                <div class="lg:text-end">
                    <button type="submit"
                        class="rounded px-2.5 py-1.5 bg-blue-600 text-white dark:bg-blue-600 hover:bg-blue-500 transition-all duration-75 w-full lg:w-32 ">
                        Güncelle
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('dropzone-file');
        const uploadArea = document.getElementById('uploadArea');
        const uploadedImage = document.getElementById('uploadedImage');
        const uploadMessage = document.getElementById('uploadMessage');
        const againuploadMessage = document.getElementById('againuploadMessage');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    uploadedImage.src = e.target.result;
                    uploadedImage.classList.remove('hidden');

                    uploadMessage.classList.add('hidden');
                    againuploadMessage.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            }
        });

        const textarea = document.getElementById('autoResizeTextarea');

        textarea.addEventListener('input', () => {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        });
    </script>
@endsection
