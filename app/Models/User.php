<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'state',
        'email',
        'phone',
        'is_email_verified',
        'password',
    ];

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
