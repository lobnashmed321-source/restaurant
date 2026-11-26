<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'restaurant:admin {email}';
    protected $description = 'Make an existing user an admin';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('No user found with this email. Register on the website first.');
            return self::FAILURE;
        }

        $user->forceFill(['role' => 'admin'])->save();
        $this->info("{$user->email} is now an admin.");

        return self::SUCCESS;
    }
}