<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LockerRental extends Model
{
    protected $fillable = [
        'id', 'user_id','locker_id', 'end_date', 'status'
    ];

    // Can have status: 'pending', 'active', 'checked-out', 'abandoned', 'cancelled'

    public function locker(){
        return $this->hasOne('App\Locker', 'id', 'locker_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function end_date(){
        return (new Carbon($this->end_date))->toFormattedDateString();
    }

    public function confirmRental(){
        $this->status = "active";
        $this->save();
        $this->locker->rent();
    }

    public function cancelRental(){
        $this->status = "active";
        $this->save();
        $this->locker->makeAvailable();
    }

    public function cancelUserRental(){
        $this->locker->makeExpired();
    }

}
