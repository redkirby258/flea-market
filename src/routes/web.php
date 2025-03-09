<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'storeUser']);
Route::post('/profile', [ProfileController::class, 'storeWeight']);
Route::post('/login', [UserController::class, 'loginUser']);

Route::get('/', [ItemController::class, 'index']);