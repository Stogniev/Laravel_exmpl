<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Button;
use App\Models\Card;
use App\Models\Block;
use App\Models\Template;
use App\Models\Payload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function index()
    {


        /*$old_template = DB::connection('mongodb')->collection('templates')->where('id_page', '553349308190563')->get();
        $old_template = $old_template->first();
        $blocks = $old_template['blocks'];
        $json = json_encode($blocks);
        dd($json);*/

        $_id = '581ca3e9b2628ac96727ad35';
        $type = 'link';
        $data = array('title' => 'new Title', 'link' => 'http://vk.com', 'postbacks' => array('Block Two', 'Block One'));

        $update_button = Button::find($_id);
        $payloads = DB::connection('mongodb')->collection('payloads')->where('button_id', $_id)->get();
        foreach ($payloads as $payload) {
            Payload::destroy($payload['_id']->__toString());
        }
        $update_button->title = $data['title'];
        $update_button->type = $type;
        if($type == 'postback'){
            foreach ($data['postbacks'] as $item){
                $update_button->payloads()->save(new Payload(['payload' => $item]));
            }
        } else {
            $update_button->link = $data['link'];
        }
        $update_button->save();

        

        /*
        //create json to front-end
        $template = DB::connection('mongodb')->collection('templates')->where('id_page', '823140621162393')->get();
        $template =$template->first();
        $blocks = DB::connection('mongodb')->collection('blocks')->where('template_id', $template['_id']->__toString())->get();
        if ($blocks->isEmpty()) {
            //$arr_to_sent = array('blocks' => array());
            $arr_blocks = array();
        } else {
            $arr_blocks = array();
            foreach ($blocks as $block) {
                $id_block = $block['_id'];
                $cards = DB::connection('mongodb')->collection('cards')->where('block_id', $id_block->__toString())->get();
                if ($cards->isEmpty()) {
                    array_push($arr_blocks, array('slug' => $block['slug'], 'name' => $block['name'], 'type' => $block['type'], 'group' => $block['group'], 'position' => $block['position'], 'cards' => array(), '_id' => $id_block->__toString(), 'template_id' => $block['template_id']));
                }
                $cards_to_send = array();
                foreach ($cards as $card) {
                    $id_card = $card['_id'];
                    $id = $id_card->__toString();
                    switch ($card['type']) {
                        case 'text':
                            $buttons = DB::connection('mongodb')->collection('buttons')->where('card_id', $id)->get();
                            if ($buttons->isEmpty()) {
                                array_push($cards_to_send, array('type' => 'text', 'text' => $card['text'], 'buttons' => array(), '_id' => $id));
                            } else {
                                $buttons_to_send = array();
                                $count = 0;
                                foreach ($buttons as $button) {
                                    $id_button = $button['_id']->__toString();
                                    if ($button['type'] == 'postback') {
                                        $payloads = DB::connection('mongodb')->collection('payloads')->where('button_id', $id_button)->get();
                                        $payl = array();
                                        foreach ($payloads as $payload) {
                                            array_push($payl, array('payload' => $payload['payload'], '_id' => $payload['_id']->__toString(), 'button_id' => $payload['button_id']));
                                        }
                                        array_push($buttons_to_send, array('title' => $button['title'], 'payloads' => $payl, '_id' => $id_button, 'card_id' => $button['card_id']));
                                    } else {
                                        array_push($buttons_to_send, array('title' => $button['title'], 'link' => $button['link'], '_id' => $id_button, 'card_id' => $button['card_id']));
                                    }
                                }
                                array_push($cards_to_send, array('type' => 'text', 'text' => $card['text'], 'buttons' => $buttons_to_send, '_id' => $id, 'block_id' => $card['block_id']));
                            }
                            break;
                        case 'image':
                            array_push($cards_to_send, array('type' => 'image', 'title' => $card['title'], 'description' => $card['description'], 'url' => $card['url'], '_id' => $id, 'block_id' => $card['block_id']));
                            break;
                        default:
                            break;

                    }
                }
                array_push($arr_blocks, array('slug' => $block['slug'], 'name' => $block['name'], 'type' => $block['type'], 'group' => $block['group'], 'position' => $block['position'], 'cards' => $cards_to_send, '_id' => $id_block->__toString(), 'template_id' => $block['template_id']));
            }
        }*/




        /*$template = new Template(['id_page' => '343634634636']);
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
        $button = new Button(['type' => 'link', 'title' => 'Client']);
        $card->buttons()->save($button);

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
        $block->cards()->save($card);*/


        /*$template = new Template(['id_page' => '823140621162393']);
        $template->save();
        $block = new Block(['slug' => 'Welcome Message Template', 'name' => 'Welcome Message', 'type' => 'welcome', 'group' => 'builtin']);
        $template->blocks()->save($block);
        $card = new Card(['type' => 'text', 'text' => 'Welcome to Bot-Funnels bot service! We are so happy to see you. Good luck!']);
        $block->cards()->save($card);
        $button = new Button(['id_button' => '1', 'type' => 'postback', 'title' => 'Developer']);
        $card->buttons()->save($button);
        $payload = new Payload(['payload' => 'New Block']);
        $button->payloads()->save($payload);
        $payload = new Payload(['payload' => 'Default Message Template']);
        $button->payloads()->save($payload);


        $card = new Card(['type' => 'image', 'title' => 'Image first', 'description' => 'Image Description', 'url' => 'http://bot-funnels.ideasoft.io/public/images/logo.png']);
        $block->cards()->save($card);

        $block = new Block(['slug' => 'Default Message Template', 'name' => 'Default Message', 'type' => 'default', 'group' => 'builtin']);
        $template->blocks()->save($block);
        $card = new Card(['type' => 'text', 'text' => 'This is default message of bot-funnels bot service! Enjoy our product!']);
        $block->cards()->save($card);

        $block = new Block(['slug' => 'New Block', 'name' => 'Default Message', 'type' => 'none', 'group' => 'fun']);
        $template->blocks()->save($block);
        $card = new Card(['type' => 'text', 'text' => 'Firts PostBack in our service! That is cool))']);
        $block->cards()->save($card);*/


        /*
        $template = DB::connection('mongodb')->collection('templates')->where('id_page', '1603584189946722')->get();
        $template = $template->first();
        $blocks = $template['blocks'];
        dd($blocks);
        return $template;*/

        /*
        $old_template = DB::connection('mongodb')->collection('templates')->where('id_page', '1603584189946722')->get();
        if ($old_template->isEmpty()){

        } else {
            $old_template = $old_template->first();
            $id = $old_template['_id'];
            $id = $id->__toString();
            $old_template = Template::find($id);
            $old_template->id_page = '454645645645754';
            $old_template->save();
        }*/

        /*public function getCardsByIDPageAndSlug($id_page, $slug){
            $template = DB::connection('mongodb')->collection('templates')->where('id_page', $id_page)->get();
            $template = $template->first();
            $id_template = $template['_id']->__toString();
            $block = DB::connection('mongodb')->collection('blocks')->where('template_id', $id_template)->where('slug', $slug)->get();
            if ($block->isEmpty()) {
                return '';
            }
            $block = $block->first();
            $id_block = $block['_id']->__toString();

        }*/
/*
        $template = DB::connection('mongodb')->collection('templates')->where('id_page', '553349308190563')->get();
        $template = $template->first();
        $id_template = $template['_id']->__toString();
        $blocks = DB::connection('mongodb')->collection('blocks')->where('template_id', $id_template)->get();
        if ($blocks->isEmpty()) {
            return '';
        }
        foreach ($blocks as $block){
            $id_block = $block['_id']->__toString();
            $json = json_encode($block);
            $array = json_decode($json, true);
            $cards = DB::connection('mongodb')->collection('cards')->where('block_id', $id_block)->get();
            if (!$cards->isEmpty()) {
                $arrcards['cards'] = array();
                foreach ($cards as $card){
                    $id_card = $card['_id'];
                    $id = $id_card->__toString();
                    $buttons = DB::connection('mongodb')->collection('buttons')->where('card_id', $id)->get();
                    if (!$buttons->isEmpty()) {
                        $arrbutton['buttons'] = array();
                        foreach ($buttons as $button){
                            $id_button = $button['_id'];
                            $id = $id_button->__toString();
                            $payloads = DB::connection('mongodb')->collection('payloads')->where('button_id', $id)->get();
                            if (!$payloads->isEmpty()){
                                $arrnew['payloads'] = $payloads;
                                if (is_array($arrnew))
                                    array_push( $button['_id'], $arrnew->toArray());
                                else
                                    $button['update_at'] = $payloads;
                            }
                            array_push($arrbutton['buttons'], $button);
                        }
                    }
                    array_push($card['_id'], $arrbutton);
                    array_push($arrcards['cards'], $card);
                }
                array_push( $array['_id'], $arrcards );
            }
            $json = json_encode($array);
            print_r($json);
        }*/




        /*$template = DB::connection('mongodb')->collection('templates')->where('id_page', '823140621162393')->get();
        $template = $template->first();
        $id = $template['_id'];
        $id = $id->__toString();
        $block = DB::connection('mongodb')->collection('blocks')->where('template_id', $id)->where('type', 'welcome')->get();
        $block = $block->first();
        $id = $block['_id'];
        $id = $id->__toString();
        $cards = DB::connection('mongodb')->collection('cards')->where('block_id', $id)->where('type', 'image')->get();
        $cards = $cards->first();
        $id = $cards['_id']->__toString();
        print_r($id);
        $card = Card::find($id);
        dd($card);*/

        //$card->delete();
        //foreach ($cards as $card) {
            //$id_card = $card['_id'];
            //$id = $id_card->__toString();
            //$buttons = DB::connection('mongodb')->collection('buttons')->where('card_id', $id)->where('id_button', '1')->get();
            //if (!$buttons->isEmpty()) {
                //foreach ($buttons as $button) {
                    /*
                     * update
                    $id = $button['_id']->__toString();
                    $button_up = Button::find($id);
                    $button_up->id_button = '2';
                    $button_up->save();*/

                    //}
                //}

                /*
                 * delete
                $buttons = $buttons->first();
                $id = $buttons['_id']->__toString();
                $button = Button::find($id);
                $button->delete();*/
                //$button = new Button(['id_button' => '2', 'type' => 'link', 'title' => 'Client', 'link' => 'https://www.facebook.com/profile.php?id=100009140770140&fref=pb&hc_location=friends_tab&pnref=friends.all']);
                //$new_card = Card::find($id);
                //$new_card->buttons()->save($button);

            //}


        //}

        /*$array = json_decode($xcv);
        return view('build', );*/

    }
}
