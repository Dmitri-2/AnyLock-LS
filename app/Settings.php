<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //Primarily intended as a key-value store table
    protected $fillable = [
        'id', 'key','value'
    ];

    // Additionally has timestamp fields

}
