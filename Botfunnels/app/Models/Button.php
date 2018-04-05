<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Card;
use App\Models\Payload;

class Button extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'buttons';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'title',
        'link'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function payloads()
    {
        return $this->hasMany(Payload::class);
    }

    /*public function payloads()
    {
        return $this->embedsMany(Payload::class);
    }*/
}
