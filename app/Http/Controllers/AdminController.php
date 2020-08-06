<?php

namespace App\Http\Controllers;

use App\Http\Service\AdminService;
use App\Http\Service\DatabaseHelper;
use App\Location;
use App\Locker;
use App\LockerRental;
use App\User;
use Illuminate\Http\Request;
use Route;
use Auth;

class AdminController extends Controller
{
    public function viewAdminDashboard(){

        $lockerRentalCount = LockerRental::count();
        $users = User::all();
        $lockers = Locker::getAllAvailable();

        return view("admin.dashboard", compact('lockerRentalCount', 'lockers', 'users'));
    }

    public function viewAllUsers(){
        $users = User::all();
        return view("admin.manageUsers", compact("users"));
    }

    public function setUserAdmin(Request $request){
        $user = User::find($request->user_id);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect(route("allUsers"))->with(['alert' => 'success', 'alertMessage' => $user->name."'s admin status has been updated."]);
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

        // Set the locker into the pending state
        $locker = Locker::find($request->locker_id);
        $locker->makePending();

        // Create the rental entry
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
        if (empty($request))
            return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => 'Error attempting to update the rental status.']);
        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->cancelRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"The locker status has been updated."]);
    }

    public function expiry_list() {
        $user = Auth::user();
        $expired = AdminService::get_rentals_by_status('expired');
        $expiring = AdminService::get_rentals_by_status('expiring');
        return view('admin.expiry', compact('expired', 'expiring', 'user'));
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
            $currentLocker = AdminService::get_locker($request->locker_id);

            if($currentLocker->status == 'rented' || $currentLocker->status == 'expiring')
            {
                if(!AdminService::update_for_broken($request->locker_id, 'active'))
                {
                    return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => "The locker status did not update. Please try again."]);
                }
            }
            else if($currentLocker->status == 'pending')
            {
                if(!AdminService::update_for_broken($request->locker_id, 'pending'))
                {
                    return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => "The locker status did not update. Please try again."]);
                }
            }

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

    public function confirmCheckedOut(request $request){
        if (empty($request))
            return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => 'Error attempting to update the rental status.']);

        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->checkOut();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"The locker status has been updated."]);
    }

    public function updateDate(request $request){
        if (empty($request))
            return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => 'Error attempting to update the rental status.']);

        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->end_date = $request->end_date;
        $rental->save();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"The rentals end date is now " . $rental->end_date]);
    }
}
