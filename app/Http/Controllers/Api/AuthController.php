<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $staff = staff::create([
            'full_name' => $request->full_name,
            'job_title' => $request->job_title,
            'role' => $request->role,
            'department_id' => $request->department_id,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $staff->createToken('embassy-api')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Staff account registered successfully.',
            'data' => [
                'staff' => $staff,
                'token' => $token,
            ],
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        /** @var staff $staff */
        $staff = Auth::user();

        $token = $staff->createToken('embassy-api')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'staff' => $staff,
                'token' => $token,
            ],
        ], 200);
    }

    public function logout(): JsonResponse
    {
        /** @var staff $staff */
        $staff = Auth::user();

        $staff->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ], 200);
    }
}