<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Http\Requests\StoredepartmentRequest;
use App\Http\Requests\UpdatedepartmentRequest;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = department::all();
        return DepartmentResource::collection($departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredepartmentRequest $request)
    {
        // 🟢 FIXED: Explicitly map your form's department_name string into your database's true "name" column slot
        $departmentRecord = department::create([
            "building_id" => $request->validated()["building_id"],
            "name" => $request->validated()["department_name"],
            "description" => $request->input("description"),
        ]);
        
        return new DepartmentResource($departmentRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedepartmentRequest $request, department $department)
    {
        // 🟢 FIXED: Safely update fields handling the exact same naming conversion rules
        $department->update([
            "building_id" => $request->validated()["building_id"] ?? $department->building_id,
            "name" => $request->validated()["department_name"] ?? $department->name,
            "description" => $request->input("description") ?? $department->description,
        ]);
        
        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(department $department)
    {
        $department->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
