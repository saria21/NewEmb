<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\staff;
use App\Http\Requests\StorestaffRequest;
use App\Http\Requests\UpdatestaffRequest;
use App\Http\Resources\StaffResource;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all embassy personnel out of the tracking table
        $allStaff = staff::all();
        return StaffResource::collection($allStaff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestaffRequest $request)
    {
        // Unpack request field validations cleanly via the spread operator
        $employeeRecord = staff::create([
            ...$request->validated()
        ]);
        return new StaffResource($employeeRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(staff $staff)
    {
        return new StaffResource($staff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestaffRequest $request, staff $staff)
    {
        // Modify fields cleanly using the unpacked request inputs
        $staff->update([
            ...$request->validated()
        ]);
        return new StaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(staff $staff)
    {
        $staff->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
