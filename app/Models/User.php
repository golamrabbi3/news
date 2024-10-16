<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verified_at',
        'is_super_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function newsComments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, News::class);
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
