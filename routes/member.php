<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
|
| Member-only routes will be placed here.
|
*/

Route::get('/dashboard', function () {
    return view('member.dashboard');
})->name('member.dashboard');