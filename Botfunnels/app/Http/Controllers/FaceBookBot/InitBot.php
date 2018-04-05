<?php

namespace App\Http\Controllers\FaceBookBot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BotService;
use Illuminate\Http\Response;

class InitBot extends Controller
{
    /*
     * @param Request $request
     */
    public function create(BotService $botService, Request $request)
    {
        //TODO:
        if (
            !empty($request->get('hub_mode'))
            && $request->get('hub_mode') == 'subscribe'
            && $request->get('hub_verify_token') == config('bot.verify_token')
        ) {
            return new Response($request->get('hub_challenge'));
        } else {
            $data = json_decode(file_get_contents("php://input"), true);

            $botService->createBot($data);
        }
    }
}
