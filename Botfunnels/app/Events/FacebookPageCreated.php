<?php

namespace App\Events;

use App\Models\Template;
use Illuminate\Queue\SerializesModels;

class FacebookPageCreated
{
    use SerializesModels;

    public $template;
    public $fb_page;

    /**
     * Create a new event instance.
     *
     * @param Template $template
     * @param $fb_page
     */

    public function __construct( $fb_page)

    {
        $this->template = New Template;
        $this->fb_page = $fb_page;
    }

}
