<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\LockerRentalService;
use App\User;
use App\Locker;
use App\Location;
use App\LockerRental;
use Auth;

class RentController extends Controller
{

    public function index()
    {
        $shapes = LockerRentalService::getShapes();
        $locations = LockerRentalService::getLocationNames();
        return view('rent', compact('shapes', 'locations'));
    }

    public function tryRent(Request $request){

        $user = Auth::User();
        $location = Location::where('name', $request->location)->get()->first();
        $locker = Locker::where('id', $request->id)->get()->first();
        if($location && $locker){
            if($location->is_available == true && $locker->status == 'available'){
                $rental = new LockerRental();
                $rental->user_id = $user->id;
                $rental->locker_id = $locker->id;
                $rendal->end_date = $request->duration;
                return redirect()->route('home')->with(['alert' => 'success', 'alertMessage' => 'Locker #' . $request->number . ' at: ' . $request->location . ' has been reserved for ' . $request->duration . ' term(s).']);
            }
        }
        return redirect()->route('rent')->with(['alert' => 'danger', 'alertMessage' => 'Locker #' . $request->number . ' at: ' . $request->location . ' was not availble. Please try again or try a different locker.']);
    }

    public function getLocationsLockers (Request $request){
        $locations = Location::where('name', $request->location)->get()->first()->getLockers();
        return response()->json($locations);
    }
}
