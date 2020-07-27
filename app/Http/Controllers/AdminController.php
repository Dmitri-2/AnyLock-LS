<?php

namespace App\Http\Controllers;

use App\LockerRental;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewAdminDashboard(){

        $lockerRentalCount = LockerRental::count();
        $userCount = User::count();

        return view("admin.dashboard", compact('lockerRentalCount', 'userCount'));
    }
}
