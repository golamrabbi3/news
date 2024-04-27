<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'name',
        'mime_type',
        'path',
        'is_featured',
        'order',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getPathAttribute($value)
    {
        return $value ? asset("storage/$value") : null;
    }
}
