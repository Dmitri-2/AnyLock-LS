<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use App\LockerRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\LockerRental;
use App\Locker;
use App\Location;
use DateTime;
use Carbon\Carbon;
use DebugBar;


class UserController extends Controller
{
    public function status() {
        $rentals = UserService::get_rentals();

        return view('locker.status', compact('rentals'));
    }

    public function viewUserPage(){
        $user = Auth::user();
        return view("userpage", compact('user'));
    }


    public function updateUserInfo(Request $request){
        $user = Auth::user();

        if(empty($request->name) || empty($request->email)){
            return redirect(route("userPage"))->with(["alert" => "danger", "alertMessage"=>"Name/email cannot be empty!"]);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect(route("userPage"))->with(["alert" => "success", "alertMessage"=>"Updated your information!"]);
    }


    public function updateUserPassword(Request $request){
        $user = Auth::user();

        if(Hash::check($request->oldpass, $user->password) === false){
            return redirect()->route("userPage")->with(["alert" => "success", "alertMessage"=>"Updated your information!"]);
        } else{
            $user->password = Hash::make($request->newpass);
            $user->save();
        }

        return redirect()->route("userPage")->with(["alert" => "success", "alertMessage"=>"Your password has been updated!"]);
    }

    public function renew_locker(Request $request){
        $lockerRentals = LockerRental::where('user_id', Auth::user()->id)->where("status", "active")->where("locker_id", $request->locker_id)->with("Locker")->orderBy('locker_id')->get();



        foreach($lockerRentals as $lockerRental)
        {
            //---------------------------error checking
            //check if the date is before or on the same day as the current endate
            $end_date = new DateTime($lockerRental->end_date);
            $currentExpDate =  Carbon::createFromFormat('Y-m-d', $end_date->format('Y-m-d'));
            $newExpDate = Carbon::createFromFormat('Y-m-d', $request->rental_end_date);
            $diffInDays = $currentExpDate->diffInDays($newExpDate, false);

            if($diffInDays <= 0)
            {
                return redirect()->route("userStatus")->with(["alert" => "danger", "alertMessage" => "The locker end date you have chosen is either the same or sooner than the current end date. Please pick a date past your current end date."]);
            }

            //----------------------update the locker
            //Check if the new date will make it expiring or rented
            $todaysDate = Carbon::now();
            $expDayDiff = $todaysDate->diffInDays($newExpDate, false);

            if($expDayDiff <= 7)
            {
                $lockerRental->locker->status = "expiring";
            }
            else{
                $lockerRental->locker->status = "rented";
            }

            $lockerRental->locker->save();

            //----------------------update the locker rental end date
            $lockerRental->end_date = $newExpDate;
            $lockerRental->save();

        }


        return redirect()->route("userStatus")->with(["alert" => "success", "alertMessage" => "You have successfully renewed your locker!"]);
    }


    public function cancelUserRental(Request $request){
        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->cancelUserRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental cancelled!"]);
    }

}
