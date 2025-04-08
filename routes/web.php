<?php

use App\Http\Controllers\LineBotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('webhook', LineBotController::class);
