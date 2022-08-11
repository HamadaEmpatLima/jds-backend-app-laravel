<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(AuthRequest $request)
    {
        $credentials = null;
        if($request->email){
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
        } else {
            $credentials = [
                'nik' => $request->nik,
                'password' => $request->password
            ];
        }
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ], 401);
        }
        $user = Auth::guard('api')->user();
        $user->access_token = $token;
        $user->token_type = 'Bearer';
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function register(UserRequest $request)
    {
        $randomProduct = ['Salad', 'Chips', 'Chair', 'Tuna', 'Fish', 'Bacon', 'Pants'];
        $formData      = $request->all();
        $formData['role']        = 'user';
        $formData['product']     = $randomProduct[rand(0, count($randomProduct) - 1)];
        $this->userRepository->create($request->all()); 
        return response()->json([
            'success' => true,
            'message' => 'Successfully created user!'
        ]);
    }
}
