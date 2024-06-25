<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\WithRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, WithRelationships;

    protected static $relationships = ['channel'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $lowerText = strtolower($text);
            $query->whereRaw('LOWER(name) like ?', ["%{$lowerText}%"]);
        })->orWhere(function ($query) use ($text) {
            $lowerText = strtolower($text);
            $query->whereRaw('LOWER(email) like ?', ["%{$lowerText}%"]);
        });
    }
}
