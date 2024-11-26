@extends('layouts.app')
@section('title')
    BlogER | İletişim
@endsection

@section('content')
    <div class="col-span-3 max-w-3xl mx-auto">
        <h1 class="mb-4 text-center font-medium text-xl tracking-wide text-slate-900 dark:text-white">Bizimle İletişime Geçin
        </h1>
        <p class="mb-6 text-slate-900 dark:text-white text-sm md:text-base ">Görüşleriniz bizim için değerlidir. Sizden gelen
            her geri bildirim, hizmetlerimizi geliştirmemize ve size daha
            iyi bir deneyim sunmamıza yardımcı olur. Lütfen düşüncelerinizi ve önerilerinizi bizimle paylaşmaktan
            çekinmeyin. Sizden alacağımız destek, daha güçlü ve müşteri odaklı bir hizmet sunmamızı sağlayacaktır.</p>

        {{-- contact form --}}
        <div class="max-w-xl mx-auto">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                {{--  --}}
                <div class="text-center">
                    <h1 class="font-medium text-lg mb-4 text-slate-900 dark:text-white">İletişim Bilgileri</h1>
                </div>
                <div class="mb-4">
                    <label for="name"
                        class="block mb-1 font-medium text-xs md:text-base text-slate-900 dark:text-white">Tam Ad</label>
                    <input type="text" name="name" id="name"
                        class="w-full focus:outline-none px-2.5 py-1.5 border dark:border-gray-700 rounded-lg bg-slate-100 dark:bg-gray-800 dark:text-white text-sm font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                        placeholder="Tam Ad">
                    @error('name')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email"
                        class="block mb-1 font-medium text-xs md:text-base text-slate-900 dark:text-white">Email</label>
                    <input type="text" name="email" id="email"
                        class="w-full focus:outline-none px-2.5 py-1.5 border dark:border-gray-700 rounded-lg bg-slate-100 dark:bg-gray-800 dark:text-white text-xs md:text-base font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                        placeholder="E-posta">
                    @error('email')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">

                    <textarea id="autoResizeTextarea"
                        class="w-full px-2.5 py-1.5 text-sm lg:text-lg bg-slate-100 dark:bg-gray-800 dark:text-white font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                        name="content" placeholder="İçerik..." rows="6"></textarea>
                    @error('content')
                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class="rounded px-2.5 py-1.5 bg-blue-600 text-white dark:bg-blue-600 hover:bg-blue-500 transition-all duration-75 w-full lg:w-32 ">
                        Gönder
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        const textarea = document.getElementById('autoResizeTextarea');

        textarea.addEventListener('input', () => {

            textarea.style.height = 'auto';

            textarea.style.height = textarea.scrollHeight + 'px';
        });
    </script>
@endsection
