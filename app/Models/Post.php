<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use \Spatie\Tags\HasTags;

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

}
