<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = Auth::user();

        // dd($request->locker_id);

        return redirect()->route("userStatus")->with(["alert" => "success", "alertMessage" => "You have successfully renewed your locker!"]);
    }

}
