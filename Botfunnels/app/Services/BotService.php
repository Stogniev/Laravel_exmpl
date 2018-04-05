<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.10.16
 * Time: 19:18
 */

namespace App\Services;

use App\Models\FacebookPage;
use ClassPreloader\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use pimax\FbBotApp;
use pimax\Messages\Message;
use pimax\Messages\MessageButton;
use pimax\Messages\StructuredMessage;
use pimax\Messages\MessageElement;
use pimax\Messages\MessageReceiptElement;
use pimax\Messages\Address;
use pimax\Messages\Summary;
use pimax\Messages\Adjustment;
use App\Models\Button;
use App\Models\Card;
use App\Models\Block;
use App\Models\Template;
use Illuminate\Support\Collection;


class BotService
{
    private $bot;

    public function createBot($data)
    {
        $page_id = $this->getIdPage($data);
        $token = $this->getTokenPage($page_id);
        $template = $this->getTemplateID($page_id);
        $this->bot = new FbBotApp($token);
        $this->send($data, $template);
    }

    private function getIdPage($data){
        if (!empty($data['entry'][0]['messaging'])) {
            foreach ($data['entry'][0]['messaging'] as $message) {
                return $message['recipient']['id'];
            }
        }
    }

    private function getTokenPage($page_id){
        $token = (FacebookPage::where('id_page', $page_id)->first())->access_token_page;

        return $token;
    }

    private function getTemplateID($page_id){
        $template = DB::connection('mongodb')->collection('templates')->where('id_page', $page_id)->get();
        $template = $template->first();
        $id = $template['_id'];
        $id = $id->__toString();
        return $id;
    }

    private function getBlockIDBuiltIn($template_id, $block_type){
        $block = DB::connection('mongodb')->collection('blocks')->where('template_id', $template_id)->where('type', $block_type)->get();
        if($block->isEmpty()) {
            return '';
        }
        $block = $block->first();
        $id = $block['_id'];

        return $id->__toString();
    }

    private function getBlockIDPostback($template_id, $postback){
        $postbacks_str = explode('*', $postback);
        $id = array();
        $count = 0;
        foreach ($postbacks_str as $item) {
            $block = DB::connection('mongodb')->collection('blocks')->where('template_id', $template_id)->where('slug', $item)->get();
            if ($block->isEmpty()) {
                return '';
            }
            $block = $block->first();
            $id_block = $block['_id'];
            $id[$count] = $id_block->__toString();
            $count++;
        }

        return $id;
    }

    private function actionSend($id_block, $sender_id){
        $cards = DB::connection('mongodb')->collection('cards')->where('block_id', $id_block)->get();
        if ($cards->isEmpty()){
            return false;
        }
        foreach ($cards as $card){
            $id_card = $card['_id'];
            $id = $id_card->__toString();
            switch ($card['type']){
                case 'text':
                    $buttons = DB::connection('mongodb')->collection('buttons')->where('card_id', $id)->get();
                    if ($buttons->isEmpty()) {
                        $this->bot->send(new Message($sender_id, $card['text']));
                    } else {
                        $buttons_to_send = array();
                        $count = 0;
                        foreach ($buttons as $button) {
                            $id_button = $button['_id'];
                            $id = $id_button->__toString();
                            if ($button['type'] == 'postback') {
                                $payloads = DB::connection('mongodb')->collection('payloads')->where('button_id', $id)->get();
                                $postback_str = '';
                                $i = 1;
                                foreach ($payloads as $payload){
                                    if($i != count($payloads)) {
                                        $postback_str = $postback_str . $payload['payload'] . '*';
                                    } else {
                                        $postback_str = $postback_str . $payload['payload'];
                                    }
                                    $i++;
                                }
                                $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_POSTBACK, $button['title'], $postback_str);
                                $count++;
                            } else {
                                $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_WEB, $button['title'], $button['link']);
                                $count++;
                            }
                        }
                        $send_arr = array('text' => $card['text'], 'buttons' => $buttons_to_send);
                        $this->bot->send(new StructuredMessage($sender_id,
                            StructuredMessage::TYPE_BUTTON, $send_arr
                        ));
                    }
                    break;
                case 'image':
                    $element = array(new MessageElement($card['title'], $card['description'], $card['url']));
                    $send_ar = array('elements' => $element);
                    $this->bot->send(new StructuredMessage($sender_id,
                        StructuredMessage::TYPE_GENERIC,
                        $send_ar
                    ));
                    break;
                default:
                    break;

            }
        }
    }

    private function send($data, $template_id){
        if (!empty($data['entry'][0]['messaging'])) {
            foreach ($data['entry'][0]['messaging'] as $message) {
                if (!empty($message['delivery'])) {
                    continue;
                }
                $postback='';
                $ids = '';
                //TODO: need if() state for cheking welcome block
                if (!empty($message['message'])) {
                    $ids = $this->getBlockIDBuiltIn($template_id, 'welcome');
                    if(empty($ids)){
                        return false;
                    }
                } else if (!empty($message['postback'])) {
                    $postback = $message['postback']['payload'];
                    $ids = $this->getBlockIDPostback($template_id, $postback);
                }
                if (is_array($ids)){
                    foreach ($ids as $id){
                        $this->actionSend($id, $message['sender']['id']);
                    }
                } else {
                    $this->actionSend($ids, $message['sender']['id']);
                }

            }
        }

    }

    /*public function send($data)
    {

        if (!empty($data['entry'][0]['messaging'])) {
            foreach ($data['entry'][0]['messaging'] as $message) {
                $this->bot->send(new Message($message['sender']['id'], 'Hi!'));
            }
        }
    }*/

    /*
     logic

                $string = file_get_contents(__DIR__ . "/template.json");
                $json = json_decode($string, true);
                $command='';
                $postback='';
//TODO: need if() state for cheking welcome block
                if (!empty($message['message'])) {
                    $command = 'welcome';
                    // ИЛИ Зафиксирован переход по кнопке, записываем как команду
                } else if (!empty($message['postback'])) {
                    $postback = $message['postback']['payload'];
                    $command ='none';
                }
                foreach ($json as $blocks){
                    foreach ($blocks as $block){
                        if ($block['type'] == $command && $block['type'] != 'none') {
                            if ($block['cards'] != null) {
                                $cards = $block['cards'];
                                foreach ($cards as $card) {
                                    switch ($card['type']) {
                                        case 'text':
                                            if ($card['buttons'] == null) {
                                                $this->bot->send(new Message($message['sender']['id'], $card['text']));
                                            } else {
                                                $buttons = $card['buttons'];
                                                $buttons_to_send = array();
                                                $count = 0;
                                                foreach ($buttons as $button) {
                                                    if ($button['type'] == 'postback') {
                                                        $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_POSTBACK, $button['title'], $button['payload']);
                                                        $count++;
                                                    } else {
                                                        $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_WEB, $button['title'], $button['link']);
                                                        $count++;
                                                    }
                                                }
                                                $send_arr = array('text' => $card['text'], 'buttons' => $buttons_to_send);
                                                $this->bot->send(new StructuredMessage($message['sender']['id'],
                                                    StructuredMessage::TYPE_BUTTON, $send_arr
                                                ));
                                            }
                                            break;
                                        case 'image':
                                            $element = array(new MessageElement($card['title'], $card['description'], $card['url']));
                                            $send_ar = array('elements' => $element);
                                            $this->bot->send(new StructuredMessage($message['sender']['id'],
                                                StructuredMessage::TYPE_GENERIC,
                                                $send_ar
                                            ));
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }
                        } elseif ($block['type'] == $command && $block['type'] == 'none' && $block['slug'] == $postback){
                            if ($block['cards'] != null) {
                                $cards = $block['cards'];
                                foreach ($cards as $card) {
                                    switch ($card['type']) {
                                        case 'text':
                                            if ($card['buttons'] == null) {
                                                $this->bot->send(new Message($message['sender']['id'], $card['text']));
                                            } else {
                                                $buttons = $card['buttons'];
                                                $buttons_to_send = array();
                                                $count = 0;
                                                foreach ($buttons as $button) {
                                                    if ($button['type'] == 'postback') {
                                                        $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_POSTBACK, $button['title']);
                                                        $count++;
                                                    } else {
                                                        $buttons_to_send[$count] = new MessageButton(MessageButton::TYPE_WEB, $button['title'], $button['link']);
                                                        $count++;
                                                    }
                                                }
                                                $send_arr = array('text' => $card['text'], 'buttons' => $buttons_to_send);
                                                $this->bot->send(new StructuredMessage($message['sender']['id'],
                                                    StructuredMessage::TYPE_BUTTON, $send_arr
                                                ));
                                            }
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }
                        }
                    }
                }
     */

}