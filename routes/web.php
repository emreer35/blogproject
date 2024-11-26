<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/iletisim', [ContactController::class, 'index'])->name('contact.index');
Route::post('iletisim/store', [ContactController::class, 'sendMail'])->name('contact.store');

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    // Route::post('login', [LoginController::class, 'store'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});


Route::middleware('auth')->prefix('blogs')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::resource('kategoriler', CategoryController::class)->only(['index', 'show', 'destroy']);
    Route::resource('kategoriler.post', PostController::class)->only(['show'])
        ->parameters([
            'kategoriler' => 'kategoriler',
            'post' => 'post'
        ]);
    Route::resource('kategoriler.post.comment', CommentController::class)->only(['store'])->parameters([
        'kategoriler' => 'kategoriler',
        'post' => 'post'
    ]);
});
// post
Route::middleware('auth')->group(function () {
    Route::get('/postlar', [PostController::class, 'index'])->name('post.index');
    Route::get('/postlar/post-olustur', [PostController::class, 'create'])->name('post.create');
    Route::post('/postlar/post-olustur', [PostController::class, 'store'])->name('post.store');
    Route::get('postlar/duzenle/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('post/post-duzenle/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/delete/{post}', [PostController::class, 'destroy'])->name('post.delete');
});
// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    ROute::put('profile-image', [ProfileController::class, 'imageUpdate'])->name('profile.update_image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});

// Password 
Route::middleware('auth')->group(function () {
    // password update
    Route::put('password', [PasswordController::class, 'store'])->name('password.update');
});

// email verification
Route::middleware('auth')->group(function () {
    // Email Verificiation notice (ihbar duyuru bildiri)
    Route::get('verify-email', [AuthController::class, 'VerificationPrompt'])
        ->name('verification.notice');
    // Email Verificiation Handler
    Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verifyHandler'])
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    // email verification noticion yapilacak || yapildi
    Route::post('email/verification-notification', [AuthController::class, 'verificationNotification'])
        ->middleware(['throttle:6,1'])->name('verification.send');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::put('/users/{id}/role', [UserController::class, 'updateRole'])->name('user.update.role');
    Route::delete('user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    Route::patch('user/{id}/update', [UserController::class, 'update'])->name('user.update');
});
