<?php

use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;


// Tienen prefix =  dashboard

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('subscriber', [SubscriberController::class, 'all'])
    ->name('subscribers.all');
