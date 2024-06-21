<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Kios_Log;
use App\Models\User_Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // API Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:user_kiosk,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $userKiosk = User_Kiosk::create($input);

        $success['token'] = $userKiosk->createToken('auth_token')->plainTextToken;
        $success['name'] = $userKiosk->name;

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil',
            'data' => $success
        ]);
    }

    // API Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $user = User_Kiosk::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;

            // Menambahkan log ke tabel kios_log
            Kios_Log::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'login_time' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password lagi',
                'data' => null
            ]);
        }
    }


    // API Logout
    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke current user token
        $user->currentAccessToken()->delete();

        // Update the kiosk log with the logout time
        Kios_Log::where('user_id', $user->id)
            ->whereNull('logout_time')
            ->update(['logout_time' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
        ]);
    }
}
