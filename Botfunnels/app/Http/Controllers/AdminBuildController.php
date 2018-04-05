<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JavaScript;


class AdminBuildController extends Controller
{

    /**
     * @return \BladeView|bool|\Illuminate\View\View ...
     * @internal param $
     */
    protected function build()
    {
        $user = Auth::user();
        $facebook_page_id = $user->facebookPage()->first();

        /*JavaScript::put([
           'page_id' => $facebook_page_id->id_page
        ]);*/

        return view('bot.build', [
            'page' => 'build',
            'style' => '',
        ]);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildForm()
    {
        return view('bot.build-form', ['page' => 'form']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildImg()
    {
        return view('bot.build-img', ['page' => 'img']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildDefault()
    {
        return view('bot.build-default', ['page' => 'default']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildAi()
    {
        return view('bot.build-ai', ['page' => 'ai']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildText()
    {
        return view('bot.build-text', ['page' => 'text']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function addBlockOther()
    {
        return view('bot.add-block-other', ['page' => 'add-block-other']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function addBlockContent()
    {
        return view('bot.add-block-content', ['page' => 'add-block-content']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function addGroup()
    {
        return view('bot.add-group', ['page' => 'add-group']);
    }

    /**
     *
     * @param
     * @return ...
     */
    protected function buildBroadcast()
    {
        return view('bot.build-broadcast', ['page' => 'broadcast']);
    }


}
