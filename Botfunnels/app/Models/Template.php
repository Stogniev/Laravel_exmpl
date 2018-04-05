<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Block;
use App\Models\Card;
use App\Models\Button;
use App\Models\Payload;

class Template extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'templates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_page'
    ];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    /*public function blocks()
    {
        return $this->embedsMany(Block::class);
    }*/

    public function facebookPage()
    {
        return $this->belongsTo(FacebookPage::class);
    }

    public function createBaseTemplate($fb_page_id, $old_page)
    {
        //TODO: upgrade this stuff
        $old_template = DB::connection('mongodb')->collection('templates')->where('id_page', $old_page)->get();
        if ($old_template->isEmpty()){
            $template = new Template(['id_page' => $fb_page_id]);
            $template->save();
            $block = new Block(['slug' => 'Welcome Message Template', 'name' => 'Welcome Message', 'type' => 'welcome', 'group' => 'builtin']);
            $template->blocks()->save($block);
            $card = new Card(['type' => 'text', 'text' => 'Welcome to Bot-Funnels bot service! We are so happy to see you. Good luck!', 'position' => '0']);
            $block->cards()->save($card);
            $button = new Button(['type' => 'postback', 'title' => 'Developer']);
            $card->buttons()->save($button);
            $payload = new Payload(['payload' => 'New Block']);
            $button->payloads()->save($payload);
            $payload = new Payload(['payload' => 'Default Message Template']);
            $button->payloads()->save($payload);


            $card = new Card(['type' => 'image', 'title' => 'Image first', 'description' => 'Image Description', 'url' => 'http://bot-funnels.ideasoft.io/public/images/logo.png', 'position' => '1']);
            $block->cards()->save($card);

            $block = new Block(['slug' => 'Newest Block', 'name' => 'Third Block', 'type' => 'none', 'group' => 'My Group']);
            $template->blocks()->save($block);
            $card = new Card(['type' => 'text', 'text' => 'Test my group', 'position' => '0']);
            $block->cards()->save($card);

            $block = new Block(['slug' => 'New Block', 'name' => 'New Block', 'type' => 'none', 'group' => 'fun']);
            $template->blocks()->save($block);
            $card = new Card(['type' => 'text', 'text' => 'Firts PostBack in our service! That is cool))', 'position' => '0']);
            $block->cards()->save($card);

            $block = new Block(['slug' => 'Default Message Template', 'name' => 'Default Message', 'type' => 'default', 'group' => 'builtin']);
            $template->blocks()->save($block);
            $card = new Card(['type' => 'text', 'text' => 'This is default message of bot-funnels bot service! Enjoy our product!', 'position' => '0']);
            $block->cards()->save($card);

            $block = new Block(['slug' => 'Again Block', 'name' => 'Fourth Block', 'type' => 'none', 'group' => 'My Group']);
            $template->blocks()->save($block);
            $card = new Card(['type' => 'text', 'text' => 'I am want to be free))', 'position' => '0']);
            $block->cards()->save($card);
        } else {
            $old_template = $old_template->first();
            $id = $old_template['_id'];
            $id = $id->__toString();
            $old_template = Template::find($id);
            $old_template->id_page = $fb_page_id;
            $old_template->save();
        }
    }
}
