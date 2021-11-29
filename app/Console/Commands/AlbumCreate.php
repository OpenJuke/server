<?php

namespace App\Console\Commands;

use App\Services\Content\AlbumService;
use Illuminate\Console\Command;

class AlbumCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album:create {title} {alternativeTitle}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an album';

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
        $title = $this->argument('title');
        $alternativeTitle = $this->argument('alternativeTitle');

        if($albumService->create($title, $alternativeTitle)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
