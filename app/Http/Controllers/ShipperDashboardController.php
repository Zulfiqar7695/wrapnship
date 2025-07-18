<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConnectedShop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShipperDashboardController extends Controller
{
  public function dashboard()
{
    $connectedShop = ConnectedShop::where('user_id', Auth::id())->first();

    if (!$connectedShop) {
        return view('shipper.dashboard', ['orders' => [], 'error' => 'No store connected.']);
    }

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' => $connectedShop->access_token,
    ])->get("https://{$connectedShop->shop_domain}/admin/api/2024-01/orders.json");

    $orders = $response->json('orders') ?? [];

    return view('shipper.dashboard', compact('orders'));
}

}
