<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiderDashboardController extends Controller
{
   public function index()
{
    return view('rider.dashboard');
}

}
