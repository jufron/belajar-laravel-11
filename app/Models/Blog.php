<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

        // public function comments()
        // {
        //     return $this->hasMany(Comment::class);
        // }

        // public function categories()
        // {
        //     return $this->belongsToMany(Category::class);
        // }

        // public function tags()
        // {
        //     return $this->belongsToMany(Tag::class);
        // }

}
