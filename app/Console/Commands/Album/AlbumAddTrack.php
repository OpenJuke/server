<?php

namespace App\Console\Commands\Album;

use App\Console\Commands\AbstractTrackAlbumCommand;

class AlbumAddTrack extends AbstractTrackAlbumCommand
{
    protected $signature = 'album:add-track {albumId} {trackId}';
    protected $description = 'Adds a track to an album';
}
