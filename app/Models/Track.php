<?php

namespace App\Models;

use App\Models\User;
use App\Models\Playlist;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public function users_who_liked()
    {
        return $this->belongsToMany(User::class, 'user_liked_track');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'track_artist');
    }
    
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
