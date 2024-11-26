<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PostPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function create(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    public function update(User $user, Post $post): bool
    {
        return $user->role === 'admin' || $user->id === $post->user_id;
    }
}
