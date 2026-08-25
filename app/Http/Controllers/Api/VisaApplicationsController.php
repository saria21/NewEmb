<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\visa_applications;
use App\Http\Requests\Storevisa_applicationsRequest;
use App\Http\Requests\Updatevisa_applicationsRequest;
use App\Http\Resources\VisaApplicationResource;

class VisaApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all diplomatic visa applications out of the directory
        $applications = visa_applications::all();
        return VisaApplicationResource::collection($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storevisa_applicationsRequest $request)
    {
        // Unpack form boundaries cleanly using the spread operator
        $application = visa_applications::create([
            ...$request->validated()
        ]);
        return new VisaApplicationResource($application);
    }

    /**
     * Display the specified resource.
     */
    public function show(visa_applications $visa_application)
    {
        return new VisaApplicationResource($visa_application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatevisa_applicationsRequest $request, visa_applications $visa_application)
    {
        // Safely update parameters inside the active application row tracking profile
        $visa_application->update([
            ...$request->validated()
        ]);
        return new VisaApplicationResource($visa_application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(visa_applications $visa_application)
    {
        $visa_application->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
