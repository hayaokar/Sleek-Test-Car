<?php

use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Protected Endpoints
Route::middleware([\App\Http\Middleware\AuthenticateWithAuthService::class])->group(function (){
    Route::resource('/cars', CarController::class);
});
