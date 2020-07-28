<?php

namespace App\Http\Service;
// This is a example service class

use App\User;
use App\Locker;
use App\Location;

class LockerRentalService
{

    // This is a function that would rent a locker and could be used in multiple controllers
    public static function rentLocker(){
    }

    public static function getShapes(){
    	
    	$array = array(array(5,3,1,2),array(2,3,3,4),array(1,1,2,2));
    	return $array;
    }

    public static function getLocationNames(){
    	$array = array();
        $lockers = Locker::all();
        foreach ($lockers as $key => $value) {
            array_push($array, $key->name);
        }
    	return $array;
    }
}