<?php


namespace App\Http\Service;

use DebugBar;
use Illuminate\Support\Facades\Auth;
use App\Location;
use App\Locker;
use App\LockerRental;
use Symfony\Component\ErrorHandler\Debug;
use DateTime;

//use Illuminate\Support\Facades\DB;

class UserService
{

    public static function get_rentals()
    {
        $lockers = LockerRental::where('user_id', Auth::user()->id)->orderBy('locker_id')->get();
        $rentals = array();

        //Loop through all user's rental's form rental_lockers table
        foreach ($lockers as $locker) {
            //get all the lockers using the locker ids that user has rented out
            $currentBuffer = Locker::where('id', $locker->locker_id)->get();
            $current = $currentBuffer[0];

            //check if locker is rented, and still rented
            $end_date = new DateTime($locker->end_date);

            //create a new object to put into the $rentals array that holds the locker rental info
            $copy = $locker;

            //get locker num
            $copy->locker_num = $current->locker_num;

            //get the locker id
            $copy->locker_id = $current->locker_id;

            //get status
            $copy->status = $current->status;

            //get location
            $location = Location::where('id', $current->location_id)->get();
            foreach ($location as $current_location) {
                  $copy->location = $current_location->name;
            }

            //push onto new array
            array_push($rentals, $copy);
        }

        return $rentals;
    }
}
