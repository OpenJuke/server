<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class UserCreate extends Command
{
    protected $signature = 'user:create {name} {email} {password}';
    protected $description = 'Create a user';

    public function handle(UserService $userService)
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if($userService->create($name, $email, $password)) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
