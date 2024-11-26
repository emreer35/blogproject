<div class="bg-slate-100 dark:bg-gray-800 p-4 lg:p-8 rounded-sm">
    <h1 class="font-medium md:text-lg lg:text-xl text-slate-900 dark:text-white mb-1">
        {{ __('Profil Fotoğrafını Düzenle') }}</h1>
    <p class="text-sm md:text-base  mb-4 text-slate-900 dark:text-white ">
        {{ __('Hesabınızın profil resmini değiştirin.') }}</p>

    <div class="max-w-2xl">
        <img class="w-28 h-28 object-cover rounded-full mb-4" id="user_image"
            src="{{ asset('assets/image/user/' . $user->image) }}" alt="user_image">
        @error('image', 'change_profile_image')
            <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
        @enderror
        {{-- buttons --}}
        <div class="mt-3">
            <form action="{{ route('profile.update_image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" name="image" id="image_input" class="hidden" onchange="previewImage(event)">
                <!-- Fotoğrafı Güncelle butonu -->
                <label for="image_input"
                    class="px-2.5 py-1.5 bg-blue-500 rounded-md text-white dark:bg-blue-500 dark:hover:bg-blue-600 hover:bg-blue-400 transition-all duration-75 cursor-pointer"
                    id="upload_button">
                    {{ __('Fotoğrafı Güncelle') }}
                </label>
                <button id="save_button" type="submit"
                    class="hidden px-2.5 py-1.5 bg-green-500 rounded-md text-white dark:bg-green-500 dark:hover:bg-green-600 hover:bg-green-400 transition-all duration-75">
                    {{ __('Kaydet') }}
                </button>
            </form>
        </div>
    </div>
</div>
