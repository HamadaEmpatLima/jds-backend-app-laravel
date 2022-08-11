<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'data' => auth()->user()
        ], 200);
    }

    public function generatePassword(UserRequest $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'nik' => $request->nik,
                'role' => $request->role,
                'password' => Helper::generatePassword()
            ]
        ], 200);
    }

    public function destroy(int $id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted'
        ], 200);
    }
}
