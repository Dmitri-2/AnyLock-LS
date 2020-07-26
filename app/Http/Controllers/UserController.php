<?php

namespace App\Http\Controllers;

use DebugBar;
use App\Http\Service\UserService;

class UserController extends Controller
{
    public function status() {
        $rentals = UserService::get_rentals();

        return view('locker.status', compact('rentals'));
    }
}
