<?php
/**
 * Created by PhpStorm.
 * User: ikneb
 * Date: 31.10.2016
 * Time: 10:34
 */

namespace App\Services;


class PageService
{

    public function subscribedAppPage($token)
    {
        $url = 'https://graph.facebook.com/v2.8/me/subscribed_apps';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=" . $token);
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
    }

    public function unsubscribedAppPage($token,$id_page){
        $url = 'https://graph.facebook.com/v2.8/' . $id_page . '/subscribed_apps';
        if ($ch = curl_init()) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=" . $token);
            $result = curl_exec($ch);
        }
    }


    public function getPage($token)
    {
        $url = 'https://graph.facebook.com/v2.8/me/accounts/subscribed_apps?access_token=' . $token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}