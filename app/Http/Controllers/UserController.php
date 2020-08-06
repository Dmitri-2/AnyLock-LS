<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use App\LockerRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function cancelUserRental(Request $request){
        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->cancelUserRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental cancelled!"]);
    }
}
