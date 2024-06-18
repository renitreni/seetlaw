<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DefaultAllUserPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:all-user-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will set all password of user to "password"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update(['password' => bcrypt('password')]);
    }
}
