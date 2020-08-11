<?php

namespace App\Http\Controllers;

use App\Http\Service\SettingsService;
use App\Settings;
use Illuminate\Http\Request;
use App\Http\Service\LockerRentalService;
use App\User;
use App\Locker;
use App\Location;
use App\LockerRental;
use Carbon\Carbon;
use DateTime;
use Auth;

class SettingsController extends Controller
{

    public function adminSettingsPage()
    {
        $settings = Settings::all();

        //Initialize settings if they don't exist
        if($settings->isEmpty()){
            SettingsService::initializeSettings();
            $settings = Settings::all();
        }

        return view('admin.manageSettings', compact('settings'));
    }


    public function updateSettingPage(Request $request){
        $setting = Settings::find($request->setting_id);
        return view("admin.updateSetting", compact("setting"));
    }

    public function updateSettingSubmit(Request $request){
        $setting = Settings::find($request->setting_id);
        $setting->value = $request->setting_value;
        $setting->save();

        return redirect()->route("adminSettings")->with(["alert" => "success", "alertMessage"=>"Setting value updated!"]);
    }

}
