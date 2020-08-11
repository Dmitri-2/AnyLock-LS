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

    public function adminLocationPage()
    {
        $locations = Location::all();

        return view('admin.manageLocations', compact('locations'));
    }
}
