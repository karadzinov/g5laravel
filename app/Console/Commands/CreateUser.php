<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user via command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $user = User::create([
           "name" =>  $this->ask('What is your name?'),
           "email" => $this->ask('What is your email?'),
           "password" => $this->secret('What is the password?'),
           "role_id" => 1
       ]);


        app(UserController::class)->sendMail($user->email);

        $this->info("Email sent to $user->email");
        $this->info($user);

    }
}
