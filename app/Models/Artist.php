<?php

namespace App\Models;

use App\Models\Track;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'track_artist');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_artist');
    }
}
