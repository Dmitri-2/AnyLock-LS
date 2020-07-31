<?php

namespace App\Http\Controllers;

use App\Http\Service\AdminService;
use App\Http\Service\DatabaseHelper;
use App\Location;
use App\Locker;
use App\LockerRental;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewAdminDashboard(){

        $lockerCount = Locker::count();
        $lockerRentalCount = LockerRental::count();
        $userCount = User::count();

        return view("admin.dashboard", compact('lockerRentalCount', 'userCount', 'lockerCount'));
    }

    public function viewAllLockers(){

        $rentals = LockerRental::all();

        return view("admin.rentals", compact("rentals"));
    }

    public function viewAdminPendingLockerRentalPage(){

        $pendingRentals = LockerRental::where("status", "pending")->with("locker")->get();
        $users = User::all();
        $lockers = Locker::getAllAvailable();

        return view("admin.pendingRentals", compact("pendingRentals", "users", "lockers"));
    }

    public function createRentalManually(Request $request){

        $rental = new LockerRental();
        $rental->locker_id = $request->locker_id;
        $rental->user_id = $request->user_id;
        $rental->end_date = $request->rental_end_date;
        $rental->status = "pending";
        $rental->save();

        if($request->has("approve_immediately")){
            $rental->confirmRental();
            return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental created and confirmed!"]);
        }

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Pending locker rental created!"]);
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

    public function expiry_list() {
        $expired = AdminService::get_expiry_list('expired');
        $expiring = AdminService::get_expiry_list('expiring');
        return view('admin.expiry', compact('expired', 'expiring'));
    }

    public function location_list(){
        $locations = AdminService::get_locations();
        $lockers = AdminService::get_lockers();

        return view('admin.lockerIssues', compact('locations', 'lockers'));
    }

    public function update_status(Request $request) {
        $route = Route::current();
        if (empty($request))
            return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => 'Error trying to delete the submission.']);

        $status = "";

        if($request->broken)
        {
            $status = "broken";
        }
        else if($request->fixed)
        {
            $status = "available";
        }
        $updateReturn = AdminService::update_locker_status($request->locker_id, $status);

        if($updateReturn)
        {
            return redirect()->back()->with(['alert' => 'success', 'alertMessage' => 'The locker status has been updated.']);
        }

        return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => "The locker status did not update. Please try again."]);
    }
}
