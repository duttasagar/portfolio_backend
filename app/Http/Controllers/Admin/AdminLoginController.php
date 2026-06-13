<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{


public function login(Request $request)
{
    try {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = AdminLogin::where('email', $request->email)->first();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => $admin
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
}


// public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required'
//         ]);

//         $admin = AdminLogin::where('email', $request->email)->first();

//         if (!$admin || !Hash::check($request->password, $admin->password)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Invalid credentials'
//             ], 401);
//         }

//         return response()->json([
//             'success' => true,
//             'user' => $admin
//         ]);
//     }

    public function logout()
    {
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

}
