<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Template;

class CreateBaseTemplate implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $page_id;
    public $old_page_id;

    public function __construct($page_id, $old_page_id)
    {
        $this->page_id = $page_id;
        $this->old_page_id = $old_page_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new Template)->createBaseTemplate($this->page_id, $this->old_page_id);
    }
}
