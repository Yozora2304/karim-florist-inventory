<?php

use App\Models\AdminAccount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\OutgoingItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminAccountController;

Route::resource('admins', AdminAccountController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::resource('incoming-items', IncomingItemController::class);
Route::resource('outgoing-items', OutgoingItemController::class);
Route::get('/reports', [ReportController::class, 'index']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function(){

    session()->flush();

    return redirect('/login');

});

Route::post('/login', function () {

    $admin = AdminAccount::where(
        'username',
        request('username')
    )->first();

    if(!$admin){
        return back()->with(
            'error',
            'Username tidak ditemukan'
        );
    }

    if($admin->password != request('password')){
        return back()->with(
            'error',
            'Password salah'
        );
    }

    if($admin->status != 'Aktif'){
        return back()->with(
            'error',
            'Akun tidak aktif'
        );
    }

    session([
        'username' => $admin->username,
        'role' => $admin->role
    ]);

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {

    $totalProducts = \App\Models\Product::count();

    $totalStock = \App\Models\Product::sum('stock');

    $totalIncoming = \App\Models\IncomingItem::sum('quantity');

    $totalOutgoing = \App\Models\OutgoingItem::sum('quantity');

    $incomingChart = \App\Models\IncomingItem::selectRaw('date, SUM(quantity) as total')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $outgoingChart = \App\Models\OutgoingItem::selectRaw('date, SUM(quantity) as total')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        return view('dashboard', compact(
        'totalProducts',
        'totalStock',
        'totalIncoming',
        'totalOutgoing',
        'incomingChart',
        'outgoingChart'
    ));

});