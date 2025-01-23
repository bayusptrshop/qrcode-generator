<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_code' => 'required|exists:users,user_code',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        try {
            if (Auth::attempt(['user_code' => $request->user_code, 'password' => $request->password])) {
                return redirect()->route('insert.excel')->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_code' => 'required|unique:users,user_code',
            'name' => 'required',
            'password' => 'required|min:8',
            'supplier_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $validator->validated();
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            return response()->json(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
