<?php

namespace App\Jobs;


use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class DisableUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dateYesterday = Carbon::yesterday();

        $users = User::where('created_at', '<', $dateYesterday->format('Y-m-d H:i:s'))->get();

        foreach ($users as $user) {
            foreach ($user->products as $product) {
                $product->delete();
            }
            $user->delete();
        }
    }
}
