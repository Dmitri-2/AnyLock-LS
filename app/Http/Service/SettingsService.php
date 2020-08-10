<?php

namespace App\Http\Service;

use App\Settings;

class SettingsService
{

    // Function to initialize all the settings variables
    public static function initializeSettings(){

        $settings = [
            "Business Name" => "AnyLock Locker Service",
            "Main Page Subtitle" => "Locker rentals shouldn't be hard. AnyLock allows you 
                                    to rent out any kind of lockers, using any kind of locks."
        ];

        //Loop and save all of the settings
        foreach($settings as $key => $value){
            $setting = new Settings();
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }

    }


}