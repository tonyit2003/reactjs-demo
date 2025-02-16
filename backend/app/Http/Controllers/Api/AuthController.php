<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(AuthLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function register(AuthRegisterRequest $request)
    {
        $user = $this->userService->create($request);
        if ($user !== null) {
            return response()->json([
                'message' => 'Register successfully',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to register. Please try again.',
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }
}
