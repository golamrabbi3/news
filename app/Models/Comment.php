<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'detail',
        'news_id',
        'comment_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function news(): HasOne
    {
        return $this->hasOne(News::class);
    }

    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class);
    }
}
