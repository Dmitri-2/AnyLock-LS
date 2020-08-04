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
        //Here we are getting all of the rentals from the locker_rentals table
        //for the user that is logged in.
        $lockers = LockerRental::where('user_id', Auth::user()->id)->orderBy('locker_id')->get();
        $rentals = array();

        //Loop through all user's rental's from rental_lockers table
        foreach ($lockers as $locker) {
            //get the locker from the locker table based on the user's locker_rentals
            $currentBuffer = Locker::where('id', $locker->locker_id)->get();
            //getting the first array position, because the above returns an array
            //with only one value.
            $current = $currentBuffer[0];

            //check if the locker_rental is active or pending
            if($locker->status == 'active' || $locker->status == 'pending')
            {
                //check if locker is rented, and still rented
                //??Not sure what this is for. I just left it in, in case it was being used for something.
                $end_date = new DateTime($locker->end_date);

                //create a new object to put into the $rentals array that holds the locker rental info
                $copy = $locker;

                //get locker num
                $copy->locker_num = $current->locker_num;

                //get the locker id. Returning this for the renewal functionality.
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

        }
        //return all of the rentals that are active or pending.
        return $rentals;
    }
}
