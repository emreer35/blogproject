@extends('layouts.app')

@section('title')
    BlogER | Users
@endsection

@section('content')
    <div class="col-span-3">




        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <form action="{{ route('user.index') }}" method="GET">
                <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                    {{-- form alaninda kaldin  --}}
                    <div class="mt-2.5">
                        <select name="per_page" onchange="this.form.submit()"
                            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">


                            <option value="10" {{ $perPage === '10' ? 'selected' : '' }}>10</option>
                            <option value="20" {{ $perPage === '20' ? 'selected' : '' }}>20</option>
                            <option value="50" {{ $perPage === '50' ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative flex">
                        <div
                            class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="relative w-80 me-3">
                            <input type="text" id="table-search" name="search" value="{{ old('search', $search) }}"
                                class=" relative w-full  block p-2 ps-5 pe-16 text-sm text-gray-900 border border-gray-300 rounded-lg  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ara">
                            <span
                                class="absolute inset-y-0 right-0 flex items-center text-xs text-white bg-blue-500 px-3 py-1 rounded-r-lg"><a
                                    href="{{ route('user.index') }}">Sıfırla</a></span>


                        </div>

                        <button type="submit"
                            class="px-2.5 py-1.5 rounded-md bg-blue-500 text-white hover:bg-blue-400 dark:hover:bg-blue-600 ">
                            Filtrele
                        </button>

                    </div>
            </form>

        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">

                        <a
                            href="{{ route('user.index', array_merge(request()->all(), ['sort_by' => 'id', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                            <div class="flex items-center ">

                                ID
                                @if ($sortBy === 'id')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a class=""
                            href="{{ route('user.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                            Tam Ad
                            @if ($sortBy === 'name')
                                {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>

                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('user.index', array_merge(request()->all(), ['sort_by' => 'email', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                            <div>
                                Email
                                @if ($sortBy === 'email')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>

                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('user.index', array_merge(request()->all(), ['sort_by' => 'role', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                            <div>
                                Rol
                                @if ($sortBy === 'role')
                                    <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>

                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a
                            href="{{ route('user.index', array_merge(request()->all(), ['sort_by' => 'created_at', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                            Oluşturma Tarihi
                            @if ($sortBy === 'created_at')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif

                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        İşlemler
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-10 p-4">
                            {{ $user->id }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('user.update.role', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit();"
                                    class="text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 flex items-center justify-start">

                            {{-- user edit --}}
                            <button data-modal-target="user-update-modal-{{ $user->id }}"
                                data-modal-toggle="user-update-modal-{{ $user->id }}"
                                class="block  text-blue-600 dark:text-blue-500 hover:underline    font-medium rounded-lg text-sm  text-center  "
                                type="button">
                                {{ __('Düzenle') }}
                            </button>

                            <!-- Modal -->
                            <div id="user-update-modal-{{ $user->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                        <div class="p-4 md:p-5">
                                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-4">
                                                    <h1 class="text-md md:text-lg"><span
                                                            class="font-bold">{{ $user->name }}</span> Kullanıcısını
                                                        Düzenle</h1>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="name"
                                                        class="block mb-1 font-medium text-xs text-slate-900 dark:text-white ">Tam
                                                        Ad</label>
                                                    <input
                                                        class="w-full focus:outline-none px-2.5 py-1.5 border dark:border-gray-700 rounded-lg bg-slate-100 dark:bg-gray-800 dark:text-white text-sm font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                                                        type="text" name="name" id="name"
                                                        value="{{ old('name' , $user->name) }}">
                                                    @error('name')
                                                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label for="email"
                                                        class="block mb-1 font-medium text-xs text-slate-900 dark:text-white ">Email</label>
                                                    <input
                                                        class="w-full focus:outline-none px-2.5 py-1.5 border dark:border-gray-700 rounded-lg bg-slate-100 dark:bg-gray-800 dark:text-white text-sm font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                                                        type="text" name="email" id="email"
                                                        value="{{  old('email' , $user->email)}}">
                                                    @error('email')
                                                        <div class="mt-1 text-xs lg:text-sm text-red-500 dark:text-red-400 ">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label for="new_password"
                                                        class="block mb-1 font-medium text-xs text-slate-900 dark:text-white ">Yeni
                                                        Sifre</label>
                                                    <input
                                                        class="w-full focus:outline-none px-2.5 py-1.5 border dark:border-gray-700 rounded-lg bg-slate-100 dark:bg-gray-800 dark:text-white text-sm font-light focus:ring-1 focus:dark:ring-1 focus:dark:ring-gray-600"
                                                        type="password" name="new_password" id="new_password"
                                                        placeholder="Yeni Şifre">
                                                </div>

                                                <div class="text-center">

                                                    <button data-modal-hide="user-update-modal-{{ $user->id }}"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        {{ __('Kullanıcıyı Düzenle') }}
                                                    </button>
                                                    <button data-modal-hide="user-update-modal-{{ $user->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        {{ __('İptal Et') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- user delete --}}
                            <button data-modal-target="user-delete-modal-{{ $user->id }}"
                                data-modal-toggle="user-delete-modal-{{ $user->id }}"
                                class="ml-3 block  text-red-500 hover:underline    font-medium rounded-lg text-sm  text-center  "
                                type="button">
                                {{ __('Sil') }}
                            </button>

                            <!-- Modal -->
                            <div id="user-delete-modal-{{ $user->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                        <div class="p-4 md:p-5 text-center">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
                                                    {{ __('Bu kullanıcıyı silmek istediğine emin misin? ') }}</h3>

                                                <p class="text-sm md:text-base mb-4 text-slate-900 dark:text-white">
                                                    {{ __('Kullanıcı silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir.') }}
                                                </p>


                                                <button data-modal-hide="user-delete-modal-{{ $user->id }}"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    {{ __('Kullanıcıyı Sil') }}
                                                </button>
                                                <button data-modal-hide="user-delete-modal-{{ $user->id }}"
                                                    type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    {{ __('İptal Et') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                @endforelse

            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $users->links() }}
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            if (@json($errors->any())) {
                const modalId = "user-update-modal-{{ $user->id }}";
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove("hidden");
                }
            }
            // Modal açma butonlarını seç
            const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');

            // Her buton için event listener ekle
            modalToggleButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-target'); // Modal ID'sini al
                    const modal = document.getElementById(modalId); // İlgili modal'ı bul

                    if (modal) {
                        modal.classList.remove('hidden'); // Modal'ı göster
                        modal.classList.add('flex'); // Flex yapısını uygula
                    }
                });
            });

            // Modal kapatma butonlarını seç
            const modalCloseButtons = document.querySelectorAll('[data-modal-hide]');

            // Her buton için event listener ekle
            modalCloseButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-hide'); // Modal ID'sini al
                    const modal = document.getElementById(modalId); // İlgili modal'ı bul

                    if (modal) {
                        modal.classList.add('hidden'); // Modal'ı gizle
                        modal.classList.remove('flex'); // Flex yapısını kaldır
                    }
                });
            });

            // Modal dışına tıklanırsa kapat
            const modals = document.querySelectorAll('.fixed.inset-0.z-50');

            modals.forEach((modal) => {
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        modal.classList.add('hidden'); // Modal'ı gizle
                        modal.classList.remove('flex'); // Flex yapısını kaldır
                    }
                });
            });
        });
    </script>
@endsection
