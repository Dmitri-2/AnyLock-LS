<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LockerRental extends Model
{
    protected $fillable = [
        'id', 'user_id','locker_id', 'end_date'
    ];
}
