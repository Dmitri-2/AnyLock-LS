<?php

namespace App\Http\Controllers;

use App\Http\Service\SettingsService;
use App\Settings;
use Illuminate\Http\Request;
use App\Http\Service\LockerRentalService;
use App\User;
    

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        if(Settings::where("key", "Business Name")->first() == null){
            SettingsService::initializeSettings();
        }

        $title = Settings::where("key", "Business Name")->first()->value ?? "AnyLock Locker System";
        $subtitle =  Settings::where("key", "Main Page Subtitle")->first()->value ?? "Set a subtitle in the settings page!";

        return view('home', compact('title', 'subtitle'));
    }

    // Show the about page
    public function about() {
        return view('about');
    }
}
