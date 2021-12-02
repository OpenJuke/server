<?php

namespace App\Console\Commands;

use App\Services\Content\AlbumService;
use Illuminate\Console\Command;

abstract class AbstractTrackAlbumCommand extends Command
{
    public function handle(AlbumService $albumService)
    {
        $albumId = $this->argument('albumId');
        $trackId = $this->argument('trackId');

        if($albumService->addTrack($albumId, $trackId)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
