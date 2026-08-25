<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\appointments;
use App\Http\Requests\StoreappointmentsRequest;
use App\Http\Requests\UpdateappointmentsRequest;
use App\Http\Resources\AppointmentResource;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all embassy calendar bookings out of the active database table
        $bookings = appointments::all();
        return AppointmentResource::collection($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreappointmentsRequest $request)
    {
        // Unpack form validations cleanly using the spread operator
        $booking = appointments::create([
            ...$request->validated()
        ]);
        return new AppointmentResource($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show(appointments $appointment)
    {
        return new AppointmentResource($appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateappointmentsRequest $request, appointments $appointment)
    {
        // Safely update parameters inside the active scheduling block
        $appointment->update([
            ...$request->validated()
        ]);
        return new AppointmentResource($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointments $appointment)
    {
        $appointment->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
