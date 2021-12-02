<?php

namespace App\Console\Commands\Album;

use App\Services\Content\AlbumService;
use Illuminate\Console\Command;

class AlbumCreate extends Command
{
    protected $signature = 'album:create {title} {alternativeTitle}';
    protected $description = 'Creates an album';

    public function handle(AlbumService $albumService)
    {
        $title = $this->argument('title');
        $alternativeTitle = $this->argument('alternativeTitle');

        if($albumService->create($title, $alternativeTitle, null)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
