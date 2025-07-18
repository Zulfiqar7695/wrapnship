<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectDashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'shipper' => redirect()->route('shipper.dashboard'),
            'rider' => redirect()->route('rider.dashboard'),
            default => abort(403),
        };
    }
}

