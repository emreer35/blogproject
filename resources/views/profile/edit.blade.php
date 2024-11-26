@extends('layouts.app')

@section('title')
    Bloger | Profile
@endsection

@section('content')
    <div class="col-span-3">

        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium text-slate-900 dark:text-white mb-1">Profilim</h1>
        <hr class="mb-4">
        <div class="mb-4">
            @include('profile.partials.profile-image-update')
        </div>
        <div class="mb-4">
            @include('profile.partials.profile-information-edit')
        </div>
        <div class="mb-4">
            @include('profile.partials.password-update')
        </div>
        <div class="mb-4">
            @include('profile.partials.profile-user-delete')
        </div>

    </div>

    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
