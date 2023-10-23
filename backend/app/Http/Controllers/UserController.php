<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // gets all users from the database
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
            
        // inserts new user into database
        $user->save();

        return response()->json(['data' => $user], 201);
    }

    /**
     * Checks if the resource has valid login credentials.
     */

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // gets user data from database by user_id
        $user = User::with('profile', 'friends')->find($id);
        return response()->json(['data' => $user], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
