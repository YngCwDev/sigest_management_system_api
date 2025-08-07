<?php

namespace App\Http\Controllers;

use App\Enums\UserProfile;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:64',
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        $roleid = $request->role_id ?? DB::table('roles')->where('profile', 'default')->value('id');

        $user = User::create([
            'username' => $request->username,
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleid
        ]);

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json([
            'token' => $token,
            'user' => $user->load('roles'),
            'welcome' => $this->getWelcomeMessage($user)
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

        $user = Auth::user()->load('roles');

        return response()->json([
            'token' => $token,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => $user,
            'welcome' => $this->getWelcomeMessage($user)
        ]);
    }

    protected function getWelcomeMessage(User $user): string
    {
        return match($user->roles->profile){
            UserProfile::ADMIN->value =>'Bem vindo admin',
            UserProfile::SUPERVISOR->value =>'Bem vindo supervisor',
            default => 'vindo alcides ',
        };
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

