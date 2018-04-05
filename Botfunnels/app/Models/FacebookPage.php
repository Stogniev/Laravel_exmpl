<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class FacebookPage extends Model
{
    use HybridRelations;
    protected $connection = 'mysql';
    protected $fillable = ['user_id', 'id_page', 'name_page', 'access_token_page'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->hasOne(Template::class);
    }
}
