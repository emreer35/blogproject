<div class="bg-slate-100 dark:bg-gray-800 p-4 lg:p-8 rounded-sm">
    <h1 class="font-medium md:text-lg lg:text-xl text-slate-900 dark:text-white mb-1">
        {{ __('Şifreni Değiştir') }}</h1>
    <p class="text-sm md:text-base  mb-4 text-slate-900 dark:text-white ">
        {{ __('Hesabınızın şifresini güncelleyin.') }}</p>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="max-w-2xl">

            <div class="mb-4">

                <label for="current_password"
                    class="block text-sm font-medium text-slate-900 dark:text-white mb-2">{{ __('Mevcut Şifre') }}</label>
                <input type="password" name="current_password" id="current_password"
                    placeholder="{{ __('Mevcut Şifre') }}"
                    class="w-full px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none">
                @error('current_password', 'password_update')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password"
                    class="block text-sm font-medium text-slate-900 dark:text-white mb-2">{{ __('Yeni Şifre') }}</label>
                <input type="password" name="password" id="password" placeholder="{{ __('Yeni Şifre') }}"
                    class="w-full px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none">
                @error('password', 'password_update')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation"
                    class="block text-sm font-medium text-slate-900 dark:text-white mb-2">{{ __('Yeni Şifre Onayla') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="{{ __('Yeni Şifre Onayla') }}"
                    class="w-full px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none">
                @error('password_confirmation', 'password_update')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit"
                class="px-2.5 py-1.5 bg-blue-500 rounded-md text-white dark:bg-blue-500 dark:hover:bg-blue-600 hover:bg-blue-400 transition-all duration-75 ">
                {{ __('Güncelle') }}
            </button>
        </div>
    </form>
</div>
