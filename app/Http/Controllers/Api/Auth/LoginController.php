<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated(), $request->has('remember_me'))) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        return response()->json([
            'message' => __('The login is successful.'),
            'data' => [
                'access_token' => Auth::user()->createToken('authToken')->plainTextToken,
                'token_type' => 'Bearer Token',
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => __('The logout is successful.'),
        ]);
    }
}
