<?php

use App\Http\Controllers\AccountListController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('percobaan2');
});

Route::group([
    'prefix' => 'admin',
], function() {

    Route::get('/accounts', [AccountListController::class, 'index'])->name('admin.index');

    Route::get('/accounts/{id}', [AccountListController::class, 'edit'])->name('admin.edit');

    Route::get('/account/add', function () {
        return view('admin.add');
    });

    Route::get('/income', function() {
        return view('admin.income');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/berandauser', function () {
    return view('berandauser');
});
// Route::get('/test',[TestController::class, 'index']);

// Route::get('/testController', [TestController::class, 'asar'] ); 

Route::get('/berandakurir',function () {
    return view('berandakurir');
});