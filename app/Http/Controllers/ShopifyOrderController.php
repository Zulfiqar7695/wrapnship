<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ShopifyOrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user->shopify_token || !$user->shop_domain) {
            return redirect()->back()->with('error', 'Shopify not connected.');
        }

        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $user->shopify_token,
        ])->get("https://{$user->shop_domain}/admin/api/2024-01/orders.json", [
            'limit' => 10
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to fetch orders.');
        }

        $orders = $response->json()['orders'];
// dd($orders);

        return view('shipper.orders', compact('orders'));
    }
}
