<?php

namespace App\Http\Controllers;

// Import the correct model, validation request layers, and output formatters
use App\Models\citizen;
use App\Http\Requests\StorecitizenRequest;
use App\Http\Requests\UpdatecitizenRequest;
use App\Http\Resources\CitizenResource;
use Illuminate\Http\JsonResponse;
class CitizenController extends Controller

{
    /**
     * GET /api/citizens
     * Fetch and return a formatted list of all tracked citizen profiles.
     */
    public function index(): JsonResponse
    {
        // Fetch all registered citizens out of your master database directory
        $citizens = citizen::all();
        
        return response()->json([
            'success' => true,
            // 🟢 Formats every single collection row using your teacher's exact resource setup
            'data'    => CitizenResource::collection($citizens)
        ], 200); // Standard HTTP 200 OK status
    }

    /**
     * POST /api/citizens
     * Register and validate a new citizen file into the embassy system.
     */
    public function store(StorecitizenRequest $request): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls data that passed through your strict Store rule gate
        $validated = $request->validated();
        $citizenRecord = citizen::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Citizen file profile successfully added to diplomatic records registry.',
            // 🟢 Formats the single output object using your new API resource map
            'data'    => new CitizenResource($citizenRecord)
        ], 201); // Custom status code for tracking logs
    }

    /**
     * GET /api/citizens/{id}
     * Display profile details for one singular targeted citizen record.
     */
    public function show(citizen $citizen): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new CitizenResource($citizen)
        ], 200);
    }

    /**
     * PUT/PATCH /api/citizens/{id}
     * Update address parameters or contact details on a live citizen entry.
     */
    public function update(UpdatecitizenRequest $request, citizen $citizen): JsonResponse
    {
        // 🟢 Safe extraction: Only pulls fields permitted by your flexible Update rule pass
        $validated = $request->validated();
        $citizen->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Citizen registration tracking records updated successfully.',
            'data'    => new CitizenResource($citizen)
        ], 200);
    }

    /**
     * DELETE /api/citizens/{id}
     * Completely remove a target citizen profile from active background tracking.
     */
    public function destroy(citizen $citizen): JsonResponse
    {
        // Clear the entry cleanly right out of the active SQLite table view
        $citizen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Citizen identification profile deleted permanently from system.'
        ], 200);
    }
}
