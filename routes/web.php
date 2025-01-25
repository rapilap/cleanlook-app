<?php

use App\Http\Controllers\AccountListController;
use App\Http\Controllers\AuthCourierController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CourierOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryAdminController;
use App\Http\Controllers\LandfillController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
})->name('loginView');
Route::post('/login', [AuthUserController::class, 'login'])->name('login');
Route::post('/register', [AuthUserController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::group([
        'prefix' => 'admin',
    ], function () {
        Route::get('/accounts', [AccountListController::class, 'index'])->name('admin.index');
        Route::get('/accounts/{id}', [AccountListController::class, 'edit'])->name('admin.edit');
        Route::get('/account/add', [AccountListController::class, 'create'])->name('admin.create');
        Route::post('/account/add', [AccountListController::class, 'store'])->name('admin.store');
        
        Route::get('/income', [HistoryAdminController::class, 'index'])->name('admin.history.index');
    
        Route::get('/location', [LandfillController::class, 'index'])->name('landfill.index');
        Route::get('/location/add', [LandfillController::class, 'create'])->name('landfill.create');
        Route::post('/location/add', [LandfillController::class, 'store'])->name('landfill.store');
        Route::get('/location/{id}', [LandfillController::class, 'edit'])->name('landfill.edit');
        Route::put('/location/{id}', [LandfillController::class, 'update'])->name('landfill.update');
        Route::delete('/location/{id}', [LandfillController::class, 'destroy'])->name('landfill.destroy');
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');
    });
    
    Route::get('/home', [OrderController::class, 'index'])->name('user.home');
    Route::get('/home/nearby', [LandfillController::class, 'getNearbyLandfills'])->name('user.nearby');
    Route::get('/home/nearby/{id}', [LandfillController::class, 'show'])->name('landfill.show');
});

Route::middleware('auth')->group(function() {
});

Route::get('/courier', function() {
return view('auth.loginCourier');
});
Route::post('/courier', [AuthCourierController::class, 'login'])->name('courier.login');

Route::middleware('auth:courier')->group(function () {
    Route::get('/courier/home', [CourierOrderController::class, 'index'])->name('courier.home');
    
    Route::get('/courier/history', function () {
        return view('courier.pendapatan');
    });
    
    Route::post('/logoutcourier', [AuthCourierController::class, 'logout'])->name('courier.logout');
});

Route::get('/detailprofile', function () {
    return view('detailprofile');
});