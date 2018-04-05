<?php

namespace App\Http\Controllers\BotBuilder;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WelcomeBuildController extends Controller
{
    public function __invoke($id_page)
    {
        $template = DB::connection('mongodb')->collection('templates')->where('id_page', $id_page)->get();
        $template = $template->first();
        $blocks = $template['blocks'];
        return json_encode($blocks);
    }


}
