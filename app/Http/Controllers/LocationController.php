<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\LockerRentalService;
use App\User;
use App\Locker;
use App\Location;
use App\LockerRental;
use Carbon\Carbon;
use DateTime;
use Auth;

class LocationController extends Controller
{

    public function adminLocationPage() {
        $locations = Location::all();

        return view('admin.manageLocations', compact('locations'));
    }


    public function createLocation(Request $request) {
        $location = new Location();
        $location->name = $request->location_name;
        $location->is_available = true;
        $location->numcols = $request->num_cols;
        $location->numrows = $request->num_rows;
        $location->height = $request->height;
        $location->width = $request->width;
        $location->depth = $request->depth;
        $location->dept = $request->department;
        $location->layout = $request->layout;
        $location->save();

        //Create the lockers at that location
        $lockersString = str_replace(["[","]"], "", $location->layout);
        $lockers = explode(",", $lockersString);
        foreach ($lockers as $lockerNum) {
            $locker = new Locker();
            $locker->locker_num = $lockerNum;
            $locker->status = "available";
            $locker->location_id = $location->id;
            $locker->save();
        }
        return redirect()->route('adminLocations')->with(['alert' => 'success', 'alertMessage' => 'The new location ('.$request->location_name.') has been created!']);
    }

    public function deleteLocation(Request $request) {
        $location = Location::find($request->location_id);

        //Delete all related lockers
        $lockers = $location->getLockers();
        foreach ($lockers as $locker) {
            $locker->delete();
        }

        $location->delete();

        return redirect()->route('adminLocations')->with(['alert' => 'success', 'alertMessage' => 'The location has been deleted!']);
    }

}
