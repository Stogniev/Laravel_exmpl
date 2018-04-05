<?php
//TODO: to whole project make comments
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function changeTokenToLongLive($social_account)
    {
        $query = "https://graph.facebook.com/oauth/access_token?client_id=" . config('services.facebook.client_id');
        $query .= "&client_secret=" . config('services.facebook.client_secret');
        $query .= "&grant_type=fb_exchange_token&fb_exchange_token=" . $social_account->access_token;

        $connection = curl_init();
        curl_setopt($connection, CURLOPT_URL, $query);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($connection);
        curl_close($connection);

        return $social_account->access_token = $result;
    }
}
