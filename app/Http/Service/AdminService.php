<?php

namespace App\Http\Service;

use App\LockerRental;
use App\Locker;
use App\Location;

class AdminService
{
    public static function get_expiry_list($status)
    {
        $lockers = Locker::all();
        $expired_list = array();

        foreach ($lockers as $locker) {
            if ($locker->status === $status) {
                $copy = $locker;
                //get the full name and email and store into locker obj
                $rentals = LockerRental::where('locker_id', $locker->id)->get();
                foreach ($rentals as $curr_rental) {
                    $full_name = $curr_rental->full_name;
                    $email = $curr_rental->email;
                    $copy->full_name = $full_name;
                    $copy->email = $email;
                }

                //get location and store into locker obj
                $locations = Location::where('id', $locker->location_id)->get();
                foreach ($locations as $location) {
                    $name = $location->name;
                    $copy->location_name = $name;
                }
                array_push($expired_list, $copy);
            }

        }
        return $expired_list;
    }

    public static function get_locations()
    {
        $locations = Location::all();
        return $locations;
    }

    public static function get_lockers()
    {
        $lockers = Locker::all();
        return $lockers;
    }

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
