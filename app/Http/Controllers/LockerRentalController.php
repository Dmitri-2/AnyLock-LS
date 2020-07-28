<?php

namespace App\Http\Controllers;

use App\Locker;
use App\LockerRental;
use Illuminate\Http\Request;

class LockerRentalController extends Controller
{

    public function viewAllLockers(){

        $rentals = LockerRental::all();

        return view("admin.rentals", compact("rentals"));
    }



    public function viewAdminPendingLockerRentalPage(){

        $pendingRentals = LockerRental::where("status", "pending")->with("locker")->get();

        return view("admin.pendingRentals", compact("pendingRentals"));
    }

    public function confirmLockerRental(Request $request){

        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->confirmRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental confirmed!"]);
    }

    public function cancelLockerRental(Request $request){
        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->cancelRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental cancelled!"]);
    }

}
