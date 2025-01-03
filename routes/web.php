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
    Route::get('/akun', function () {
        return view('admin.akun');
    });

    Route::get('/tambah', function () {
        return view('admin.add');
    });
});


// Route::get('/test',[TestController::class, 'index']);

// Route::get('/testController', [TestController::class, 'asar'] ); 