<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\consular_request;
use App\Http\Requests\Storeconsular_requestsRequest;
use App\Http\Requests\Updateconsular_requestsRequest;
use App\Http\Resources\ConsularRequestResource;

class ConsularRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pull all bureaucratic consular files from the active database table
        $requests = consular_request::all();
        return ConsularRequestResource::collection($requests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeconsular_requestsRequest $request)
    {
        // Unpack dynamic request form inputs using the spread operator
        $consularRecord = consular_request::create([
            ...$request->validated()
        ]);
        return new ConsularRequestResource($consularRecord);
    }

    /**
     * Display the specified resource.
     */
    public function show(consular_request $consular_request)
    {
        return new ConsularRequestResource($consular_request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateconsular_requestsRequest $request, consular_request $consular_request)
    {
        // Safely update parameters inside the targeted paperwork row profile
        $consular_request->update([
            ...$request->validated()
        ]);
        return new ConsularRequestResource($consular_request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(consular_request $consular_request)
    {
        // Wipe the specific tracking row from storage cleanly
        $consular_request->delete();
        return response()->json([
            "message" => "deleted"
        ], 200);
    }
}
