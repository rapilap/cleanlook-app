<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('percobaan2');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin'
], function() {
    Route::get('/accounts', function () {
        return view('admin.akun');
    });

    Route::get('/add', function () {
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