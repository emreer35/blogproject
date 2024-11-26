<div class="bg-slate-100 dark:bg-gray-800 p-4 lg:p-8 rounded-sm">
    <h1 class="font-medium md:text-lg lg:text-xl text-slate-900 dark:text-white mb-1">
        {{ __('Profilini Düzenle') }}</h1>
    <p class="text-sm md:text-base  mb-4 text-slate-900 dark:text-white ">
        {{ __('Hesabınızın profil bilgilerini ve e-posta adresini güncelleyin.') }}</p>

    <form id="verification-send" action="{{ route('verification.send') }}" method="POST">
        @csrf
    </form>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="max-w-2xl">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-900 dark:text-white mb-2">Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none"
                    value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 ">
                <p class="text-xs lg:text-sm mb-1 font-light text-slate-900 dark:text-white"><span
                        class="text-red-600 dark:text-red-400">*</span>{{ __(' E-posta adresinizi değiştirdikten sonra e-posta adresinizi yeniden doğrulamanı gerekmektedir.') }}
                </p>
                <label for="email"
                    class="block text-sm font-medium text-slate-900 dark:text-white mb-2">Email</label>
                <div class="relative flex items-center">
                    <input type="text" name="email" id="email" required
                        class="relative w-full px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none"
                        value="{{ old('email', $user->email) }}">
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <button type="submit" form="verification-send"
                            class="absolute right-0 rounded-r text-white bg-blue-500 hover:bg-blue-400 dark:hover:bg-blue-600 px-2.5 py-1.5">{{ __("Email'i Doğrula") }}</button>
                    @else
                        <span class="absolute right-0 text-white bg-blue-500 px-2.5 py-1.5 rounded-r">E-posta
                            Doğrulandı</span>
                    @endif
                </div>
                @error('email')
                    <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                @enderror

                @if (session('status') === 'verification-send-email')
                    <div>
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('E-posta adresinize yeni bir doğrulama bağlantısı gönderildi.') }}
                        </p>
                    </div>
                @endif
                @if (session('status') === 'verification-notification')
                    {{-- modal ac e posta adresinizi dogrualamk icin giriniz --}}
                    <div>
                        <p class="mt-2 font-medium text-sm text-red-600">
                            {{ __('E-posta adresinizi doğrulayınız.') }}
                        </p>
                    </div>
                @endif
                @if (session('status') === 'verified-email')
                    
                    <div>
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('E-posta adresiniz başarıyla doğrulandı.') }}
                        </p>
                    </div>
                @endif


            </div>
            <button type="submit"
                class="px-2.5 py-1.5 bg-blue-500 rounded-md text-white dark:bg-blue-500 dark:hover:bg-blue-600 hover:bg-blue-400 transition-all duration-75 ">
                {{ __('Kaydet') }}
            </button>
        </div>
    </form>
</div>
