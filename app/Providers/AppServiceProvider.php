<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('categories', Category::all());

        Password::defaults(function () {
            return Password::min(6);
        });

        Gate::policy(Post::class, PostPolicy::class);
    }
}
