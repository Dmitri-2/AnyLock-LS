<?php

namespace App\Http\Controllers;

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
        return view('home');
    }

    // Show the about page
    public function about() {
        return view('about');
    }
}
