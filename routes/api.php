<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 🟢 Both controller imports pointing strictly into your modern Api folder namespace
use App\Http\Controllers\Api\CitizenController;
use App\Http\Controllers\Api\VisaApplicationsController;

Route::prefix("v1")->group(function() {

    // 1. Citizen Registry Log Directory Channels
    Route::apiResource('citizens', CitizenController::class);
    
    // 2. Visa Applications Relational Tracking Pipelines
    Route::apiResource('visa-applications', VisaApplicationsController::class);

});
