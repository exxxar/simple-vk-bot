<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $fillable = [
        'keyword',
        'answer',
        'is_active'
    ];
}
