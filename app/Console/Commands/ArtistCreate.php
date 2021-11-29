<?php

namespace App\Console\Commands;

use App\Services\Content\ArtistService;
use Illuminate\Console\Command;

class ArtistCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artist:create {name} {alternativeName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an artist';

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
    public function handle(ArtistService $artistService)
    {
        $name = $this->argument('name');
        $alternativeName = $this->argument('alternativeName');

        if($artistService->create($name, $alternativeName)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
