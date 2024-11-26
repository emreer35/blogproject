<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $guarded = [];
    protected $casts = [
        'published_at' => 'datetime'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'title'; // veya 'slug' kullanabilirsiniz
    }

    public function scopeCommentCount(Builder|QueryBuilder $builder): Builder | QueryBuilder
    {
        return $builder->withCount('comments');
    }
}
