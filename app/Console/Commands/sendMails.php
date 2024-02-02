<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\UserInfo;
use Illuminate\Support\Facades\Mail;

class sendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email on new users';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $dateYesterday = Carbon::yesterday();

        $users = User::where('created_at', '>', $dateYesterday->format('Y-m-d H:i:s'))->get();
        foreach($users as $user)
        {
            $message = "Welcome $user->name to our webapp";
            Mail::to('martin@pingdevs.com')->send(new UserInfo($user, $message));
        }

        $this->info("Success");
    }
}
