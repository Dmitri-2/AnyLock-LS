<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\AdminService;

class LockerIssuesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //TODO: Uncomment this so that you have to log in to view the page
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function location_list(){
        // $user = Auth::user();
        // $userId = $user->id;

        $locations = AdminService::get_locations();
        $lockers = AdminService::get_lockers();

        return view('admin.lockerIssues', compact('locations', 'lockers'));
    }
}
