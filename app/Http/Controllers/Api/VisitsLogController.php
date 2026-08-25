<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\visits_logs;
use App\Http\Requests\Storevisits_logRequest;
use App\Http\Requests\Updatevisits_logRequest;
use App\Http\Resources\VisitsLogResource;

class VisitsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all active checkpoint logs out of your database table
        $logs = visits_logs::all();
        return VisitsLogResource::collection($logs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storevisits_logRequest $request)
    {
        // Unpack form validations cleanly using your exact model class bindings
        $logRecord = visits_logs::create([
            ...$request->validated()
        ]);
        return new VisitsLogResource($logRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(visits_logs $visits_log)
    {
        return new VisitsLogResource($visits_log);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatevisits_logRequest $request, visits_logs $visits_log)
    {
        // Safely update parameters inside the active security file slot
        $visits_log->update([
            ...$request->validated()
        ]);
        return new VisitsLogResource($visits_log);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visits_logs $visits_log)
    {
        // Cleanly wipe the security tracker item from your SQLite table files
        $visits_log->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
