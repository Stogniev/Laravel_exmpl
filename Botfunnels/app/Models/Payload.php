<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Button;

class Payload extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'payloads';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payload'
    ];

    public function button()
    {
        return $this->belongsTo(Button::class);
    }
}
