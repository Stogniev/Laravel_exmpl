<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Card;
use App\Models\Template;

class Block extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'blocks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'type',
        'group'
    ];


    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /*public function cards()
    {
        return $this->embedsMany(Card::class);
    }*/

}
