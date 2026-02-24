<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\BaptismController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\ConfirmationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('members', MemberController::class);
    Route::resource('families', FamilyController::class);
    Route::resource('baptisms', BaptismController::class);
    Route::resource('marriages', MarriageController::class);
    Route::resource('deaths', DeathController::class);
    Route::resource('confirmations', ConfirmationController::class);
});

require __DIR__.'/auth.php';
