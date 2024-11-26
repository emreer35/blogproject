<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'title'; // veya 'slug' kullanabilirsiniz
    }

    public function scopeRandomPosts(Builder|QueryBuilder $builder): Builder|QueryBuilder
    {
        return $builder->inRandomOrder();
    }
}
