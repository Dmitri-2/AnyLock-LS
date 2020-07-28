<?php

namespace App\Http\Controllers;

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
}
