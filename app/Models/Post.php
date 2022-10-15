<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    use \Spatie\Tags\HasTags;
    use Sluggable;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the PostContent for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function PostContent(): HasMany
    {
        return $this->hasMany(PostContent::class, 'post_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'            => 'post_title',
                'slugEngineOptions' => [
                    'lowercase' => false,
                ],
            ],
        ];
    }
}
