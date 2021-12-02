<?php

namespace App\Console\Commands\Album;

use App\Services\Content\AlbumService;
use Illuminate\Console\Command;

class AlbumAddArtist extends Command
{
    protected $signature = 'album:add-artist {albumId} {artistId}';
    protected $description = 'Adds an artist to an album';

    public function handle(AlbumService $albumService)
    {
        $albumId = $this->argument('albumId');
        $artistId = $this->argument('artistId');

        if($albumService->addArtist($albumId, $artistId)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
