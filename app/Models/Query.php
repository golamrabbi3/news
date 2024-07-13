<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_contact',
        'address',
        'subject',
        'message',
    ];

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }
}
