<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSettingsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

use Request;

class ProfileSettingController extends Controller
{
    protected function uploadProfile(UserSettingsRequest $request)
    {


        if (Request::isMethod('post')) {
            $avatar = '';

            $file = Request::file('avatar');
            $name = Request::input('name');
            $password = Request::input('password');
            $email = Request::input('email');


            if (Request::file('avatar') != null) {
                $destinationPath = base_path() . '/public/avatar/';
                $fileName = md5(microtime() . rand(0, 9999)) . '.jpg';
                Request::file('avatar')->move($destinationPath, $fileName);
                $avatar = 'https://bot-funnels.ideasoft.io/public/avatar/' . $fileName;
            }else{
                if(isset(Auth::user()->avatar)) $avatar = Auth::user()->avatar;
            }


            if ($password == null) {
                $password = Auth::user()->password;
            }else{

                $password = Hash::make($password);
            }

            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'avatar' => $avatar,
                ]);
        }
        return redirect()->to(url('/profile'));
    }

    protected function openPage()
    {
        if (!isset(Auth::user()->id)) {
            return redirect('auth/login');
        }

        return view('setting-profile.profile');
    }

}
