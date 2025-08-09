<?php

namespace App\Http\Controllers;

use App\Enums\UserProfile;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Gate;
class AuthController extends Controller
{
    
   public function register(Request $request)
    {

    if (!Gate::allows('is-admin')) {
        return response()->json(['error' => 'Unauthorized access'], 403);
    }

    $request->validate([
        'username' => 'required|string|max:64',
        'name' => 'required|string|max:64',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'role_id' => 'nullable|exists:roles,id'
    ]);

    $roleId = $request->role_id ?? Roles::where('profile', UserProfile::DEFAULT->value)->value('id');

    $user = User::create([
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $roleId
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json([
        'token' => $token,
        'user' => $user->load('role') 
    ], 201);
}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = Auth::user()->load('role');

        return response()->json([
            'token' => $token,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => $user
        ]);
    }


    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getUser()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to fetch user profile'], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();
            $user->update($request->only(['name', 'email']));
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to update user'], 500);
        }
    }
}

