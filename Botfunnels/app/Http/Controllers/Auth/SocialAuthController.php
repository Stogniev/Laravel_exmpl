<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialAccountService;

class SocialAuthController extends Controller
{
    /**
     * Redirect to facebook
     *
     * @return mixed
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->scopes(['manage_pages', 'publish_pages', 'pages_messaging'])->redirect();
    }

    /**
     * Callback action with data from facebook
     *
     * @param SocialAccountService $service
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function callback(SocialAccountService $service, Request $request)
    {
        if($request['error'])
            return redirect()
                ->to('/login')
                ->with('errors', 'Access Denied');

        $user = $service->createOrGetUser(
            Socialite::driver('facebook')
                ->stateless()
                ->user()
        );
        auth()->login($user);


        return redirect()->to('bot/setting');
    }
}
