<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 🟢 All controller imports pointing strictly into your modern Api folder namespace
use App\Http\Controllers\Api\CitizenController;
use App\Http\Controllers\Api\VisaApplicationsController;
use App\Http\Controllers\Api\AppointmentsController;
use App\Http\Controllers\Api\ConsularRequestController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\VisitsLogController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes Configuration Hub
|--------------------------------------------------------------------------
*/

Route::prefix("v1")->group(function() {
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);
    });


    // 1. Citizen Registry Log Directory Channels
    Route::apiResource('citizens', CitizenController::class);
    
    // 2. Visa Applications Relational Tracking Pipelines
    Route::apiResource('visa-applications', VisaApplicationsController::class);

    // 3. Embassy Appointment Scheduling Endpoints
    Route::apiResource('appointments', AppointmentsController::class);

    // 4. Diplomatic Consular Paperwork & Notary Trackers
    Route::apiResource('consular-requests', ConsularRequestController::class);

    // 5. Infrastructure Department Sector Managers
    Route::apiResource('departments', DepartmentController::class);

    // 6. Internal Embassy Staff & Structural Worker Directories
    Route::apiResource('staff', StaffController::class);

    // 7. Compound Compound Access Logs & Security Checkpoints
    Route::apiResource('visits-logs', VisitsLogController::class);

});
