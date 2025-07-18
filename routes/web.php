<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ShipperDashboardController;
use App\Http\Controllers\RiderDashboardController;
use App\Http\Controllers\ShopifyOrderController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ConnectedShop;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:shipper'])->get('/shipper/orders', [ShopifyOrderController::class, 'index'])->name('shopify.orders');

Route::middleware(['auth'])->get('/redirect-dashboard', [RedirectDashboardController::class, 'index'])->name('redirect.dashboard');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:shipper'])->get('/shipper/dashboard', [ShipperDashboardController::class, 'index'])->name('shipper.dashboard');
Route::middleware(['auth', 'role:rider'])->get('/rider/dashboard', [RiderDashboardController::class, 'index'])->name('rider.dashboard');





Route::get('/shopify/callback', function (\Illuminate\Http\Request $request) {
    $shop = $request->get('shop');
    $code = $request->get('code');

    $response = Http::post("https://{$shop}/admin/oauth/access_token", [
        'client_id' => env('SHOPIFY_API_KEY'),
        'client_secret' => env('SHOPIFY_API_SECRET'),
        'code' => $code,
    ]);

    if ($response->failed()) {
        return "Error: " . $response->body();
    }

    $accessToken = $response->json('access_token');

    // Save token and shop
    ConnectedShop::updateOrCreate(
        ['user_id' => Auth::id()],
        [
            'shop_domain' => $shop,
            'access_token' => $accessToken,
        ]
    );

    return redirect('/shipper/dashboard')->with('success', 'Store connected!');
});
require __DIR__.'/auth.php';
