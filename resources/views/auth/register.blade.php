<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bloger | Kayıt Ol</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/js/app.js') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>




    <div class="font-[sans-serif] bg-white md:h-screen">
        <div class="grid md:grid-cols-2 items-center gap-8 h-full">
            <div class="max-md:order-1 p-4  h-full">
                <img src="{{ asset('assets/image/1.png') }}"
                    class="lg:max-w-[90%] w-full h-full object-contain block mx-auto" alt="login-image" />
            </div>

            <div class="flex items-center p-6 h-full w-full">
                <form class="max-w-lg w-full mx-auto" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-12">
                        <h3 class="text-blue-500 md:text-3xl text-2xl font-extrabold max-md:text-center">
                            {{ __('Yeni Hesap Oluştur') }}</h3>
                    </div>

                    <div>
                        <label class="text-gray-800 text-xs block mb-2">{{ __('Tam Ad') }}</label>
                        <div class="relative flex items-center">
                            <input name="name" type="text" required
                                class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none"
                                placeholder="Tam Ad" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                                <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                <path
                                    d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                    data-original="#000000"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="text-gray-800 text-xs block mb-2">{{ __('Email') }}</label>
                        <div class="relative flex items-center">
                            <input name="email" type="text" required
                                class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none"
                                placeholder="Email" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                                <defs>
                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                    <path fill="none" stroke-miterlimit="10" stroke-width="40"
                                        d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                        data-original="#000000"></path>
                                    <path
                                        d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z"
                                        data-original="#000000"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="text-gray-800 text-xs block mb-2">{{ __('Şifre') }}</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password" required id="password"
                                class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none"
                                placeholder="Şifre" />

                            <svg id="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" fill="#bbb"
                                stroke="#ccc" class="w-[18px] h-[18px] absolute right-2 cursor-pointer"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <!-- Eye closed icon (for hiding password) -->
                            <svg id="hidePassword" xmlns="http://www.w3.org/2000/svg" fill="none" fill="#bbb"
                                stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer hidden"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 rounded" />
                        <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                            <a href="javascript:void(0);"
                                class="text-blue-500 font-semibold hover:underline ml-1">{{ __('Şartlar ve Koşulları ') }}</a>{{ __('Kabul Ediyorum') }}
                        </label>
                    </div>

                    <div class="mt-12">
                        <button type="submit"
                            class="w-full py-3 px-6 text-sm tracking-wider font-semibold rounded-md bg-blue-600 hover:bg-blue-700 text-white focus:outline-none">
                            {{ __('Yeni Hesap Oluştur') }}
                        </button>
                        <p class="text-sm mt-6 text-gray-800">{{ __('Hesabın var mı? ') }} <a
                                href="{{ route('login') }}"
                                class="text-blue-500 font-semibold hover:underline ml-1">{{ __('Giriş Yap') }} </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div id="success-message"
            class="absolute z-30 top-20 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white dark:bg-white dark:text-slate-900 p-3 rounded-sm shadow-md opacity-100 translate-y-0 transition-all duration-500 w-96 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="error-message"
            class="absolute z-30 top-20 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white dark:bg-white dark:text-slate-900 p-3 rounded-sm shadow-md opacity-100 translate-y-0 transition-all duration-500 w-96 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <script>
        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.classList.remove('opacity-100', 'translate-y-0')
                successMessage.classList.add('opacity-0', '-translate-y-full');
            }
            if (errorMessage) {
                errorMessage.classList.remove('opacity-100', 'translate-y-0')
                errorMessage.classList.add('opacity-0', '-translate-y-full');
            }
        }, 3000); // 3 saniye sonra kaybolacak
    </script>

    <script src="{{ asset('assets/js/account.js') }}"></script>

</body>

</html>
