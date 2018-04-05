<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BroadcastPageController extends Controller
{
    protected function openPage(){
        if (!isset(Auth::user()->id))
        {
            return redirect('auth/login');
        }

        return view('broadcast.broadcast',['style' => 'broadcast']);

    }
}
