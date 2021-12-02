<?php

namespace App\Console\Commands\Track;

use App\Console\Commands\AbstractTrackAlbumCommand;

class TrackAddAlbum extends AbstractTrackAlbumCommand
{
    protected $signature = 'track:add-album {trackId} {albumId}';
    protected $description = 'Adds an album to a track';
}
