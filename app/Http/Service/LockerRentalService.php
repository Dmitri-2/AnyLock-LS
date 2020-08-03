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
    	
        //$array = array(array(0),array(1,2,3),array(4,5,6),array(7,8,9));
        //$loc->layout = json_encode($array);
        //$loc->save();

        $array = array();
        $location = Location::all();
        foreach ($location as $loc) {
            array_push($array, $loc->layout);
        }
        return $array;
    }

    public static function getLocationNames(){
    	$array = array();
        $location = Location::all();
        foreach ($location as $loc) {
            array_push($array, $loc->name);
        }
    	return $array;
    }


}