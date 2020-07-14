<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'id', 'locker_num','status', 'location_id'
    ];
}
