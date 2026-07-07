<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All administrator routes will be placed here.
|
*/

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
