<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'order',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class)->withTimestamps();
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
