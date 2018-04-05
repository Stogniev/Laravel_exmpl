<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetLongLiveToken implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    public $social_account;
    /**
     * Create a new job instance.
     *
     * @param $social_account
     */
    public function __construct($social_account)
    {
        $this->social_account = $social_account;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $social_account = $this->social_account->socialAccount()->first();

        $social_account->changeTokenToLongLive($social_account);
    }
}
