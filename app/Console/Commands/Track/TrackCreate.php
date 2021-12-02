<?php

namespace App\Console\Commands\Track;

use App\Services\Content\TrackService;
use Illuminate\Console\Command;

class TrackCreate extends Command
{
    protected $signature = 'track:create {title} {alternativeTitle}';
    protected $description = 'Creates a track';

    public function handle(TrackService $trackService)
    {
        $title = $this->argument('title');
        $alternativeTitle = $this->argument('alternativeTitle');

        if($trackService->create($title, $alternativeTitle, null, null, null, null, null)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
