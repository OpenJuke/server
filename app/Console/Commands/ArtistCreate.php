<?php

namespace App\Console\Commands;

use App\Services\Content\ArtistService;
use Illuminate\Console\Command;

class ArtistCreate extends Command
{
    protected $signature = 'artist:create {name} {alternativeName}';
    protected $description = 'Creates an artist';

    public function handle(ArtistService $artistService)
    {
        $name = $this->argument('name');
        $alternativeName = $this->argument('alternativeName');

        if($artistService->create($name, $alternativeName, null)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
