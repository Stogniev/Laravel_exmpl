<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiPageController extends Controller
{
    protected function openPage(){
        if (!isset(Auth::user()->id))
        {
            return redirect('auth/login');
        }

        return view('ai.ai',['style' => 'ai']);

    }
}
