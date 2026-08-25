<?php

namespace App\Http\Controllers\Api;

// Import the base Controller and your model layers
use App\Http\Controllers\Controller;
use App\Models\citizen;
use App\Http\Requests\StorecitizenRequest;
use App\Http\Requests\UpdatecitizenRequest;
use App\Http\Resources\CitizenResource;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all citizens out of your master database directory
        $citizens = citizen::all();

        // 🟢 Teacher Style: Pass the rows directly through the Collection wrapper
        return CitizenResource::collection($citizens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecitizenRequest $request)
    {
        // 🟢 Teacher Style: Unpack validated data dynamically using the spread operator
        $citizenRecord = citizen::create([
            ...$request->validated()
        ]);

        // 🟢 Teacher Style: Wrap the new object inside a single Resource instance
        return new CitizenResource($citizenRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(citizen $citizen)
    {
        // 🟢 Teacher Style: Expose a single targeted resource entity profile
        return new CitizenResource($citizen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecitizenRequest $request, citizen $citizen)
    {
        // 🟢 Update fields using the unpacked validated request array
        $citizen->update([
            ...$request->validated()
        ]);

        return new CitizenResource($citizen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(citizen $citizen)
    {
        // Clear the entry cleanly right out of the active database table view
        $citizen->delete();

        // 🟢 Teacher Style: Drop a clean data string confirmation block
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
