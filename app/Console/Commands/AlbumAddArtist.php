<?php

namespace App\Console\Commands;

use App\Services\Content\AlbumService;
use Illuminate\Console\Command;

class AlbumAddArtist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album:add-artist {albumId} {artistId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds an artist to an album';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
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
