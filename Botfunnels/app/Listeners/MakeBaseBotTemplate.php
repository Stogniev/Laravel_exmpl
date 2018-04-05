<?php

namespace App\Listeners;

use App\Jobs\CreateBaseTamplate;
use App\Events\FacebookPageCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class MakeBaseBotTemplate implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  FacebookPageCreated  $event
     * @return void
     */
    public function handle(FacebookPageCreated $event )
    {
        try {
            dispatch(new CreateBaseTemplate($event));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
