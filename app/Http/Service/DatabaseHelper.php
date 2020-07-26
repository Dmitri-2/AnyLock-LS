<?php

namespace App\Http\Service;

use App\LockerRental;
use App\Locker;
use App\Location;
use App\User;

class DatabaseHelper {
    public static function update_locker_status($locker_id, $status){
        $locker = Locker::find($locker_id);

        if($locker){
            $locker->status = $status;
            $locker->save();
            return true;
        }
        else{
            return false;
        }
    }
}
