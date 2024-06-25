<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;

    protected static $relationships = ['playlists', 'videos', 'user'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $lowerText = strtolower($text);
            $query->whereRaw('LOWER(name) like ?', ["%{$lowerText}%"]);
        });
    }
}
