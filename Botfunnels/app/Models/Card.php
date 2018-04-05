<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Button;
use App\Models\Block;

class Card extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'cards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'position',
        'text',
        'title',
        'description',
        'url',
        'position'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function buttons()
    {
        return $this->hasMany(Button::class);
    }

    /*public function buttons()
    {
        return $this->embedsMany(Button::class);
    }*/

}
