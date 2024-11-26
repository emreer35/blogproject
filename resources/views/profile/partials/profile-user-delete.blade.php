<div class="bg-slate-100 dark:bg-gray-800 p-4 lg:p-8 rounded-sm">
    <h1 class="font-medium md:text-lg lg:text-xl text-slate-900 dark:text-white mb-1">
        {{ __('Hesabını Sil') }}</h1>
    <p class="text-sm md:text-base  mb-4 text-slate-900 dark:text-white">
        {{ __('Hesabınız silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir.') }}
    </p>
    <button data-modal-target="user-delete-modal" data-modal-toggle="user-delete-modal"
        class="block text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
        type="button">
        {{ __('Hesabımı Sil') }}
    </button>

    <!-- Modal -->
    <div id="user-delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="p-4 md:p-5 text-center">
                    <form action="{{route('profile.delete')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{ __('Hesabını silmek istediğine emin misin? ') }}</h3>
                        <p class="text-sm md:text-base mb-4 text-slate-900 dark:text-white">
                            {{ __('Hesabınız silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir.') }}
                        </p>
                        {{-- <label for="password"
                            class="block text-start text-sm font-medium text-slate-900 dark:text-white mb-1">{{ __('Mevcut Şifre') }}</label> --}}
                        <input type="password" name="password" id="password" placeholder="{{ __('Mevcut Şifre') }}"
                            class="w-full block mb-4 px-2.5 py-1.5 text-sm lg:text-base border text-slate-900 dark:text-white rounded focus:ring-1 focus:ring-gray-300  dark:bg-gray-700 focus:outline-none">
                        @error('password', 'userDeletion')
                            <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">{{ $message }}</div>
                        @enderror
                        <button data-modal-hide="user-delete-modal" 
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            {{ __('Hesabımı Sil') }}
                        </button>
                        <button data-modal-hide="user-delete-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            {{ __('İptal Et') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
