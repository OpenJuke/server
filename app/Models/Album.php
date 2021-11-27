<?php

namespace App\Models;

use App\Models\Artist;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'album_artist');
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
