<?php

use App\Http\Controllers\Web\FootballController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FootballController::class, 'index'])->name('football.index');


