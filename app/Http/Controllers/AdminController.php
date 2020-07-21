<?php

namespace App\Http\Controllers;

use App\Http\Service\AdminService;

class AdminController extends Controller
{
    public function expiry_list() {
       $expired = AdminService::get_expiry_list('expired');
       $expiring = AdminService::get_expiry_list('expiring');
       return view('admin.expiry', compact('expired', 'expiring'));
    }

}

