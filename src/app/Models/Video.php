<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected static $relationships = ['channel', 'playlists', 'categories', 'comments'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function scopeFromPeriod($query, ?Period $period)
    {
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $lowerText = strtolower($text);
            $query->whereRaw('LOWER(title) like ?', ["%{$lowerText}%"])
                ->orWhereRaw('LOWER(description) like ?', ["%{$lowerText}%"]);
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
