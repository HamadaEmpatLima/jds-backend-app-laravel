<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/hello', function (Request $request) {
//     return response()->json([
//         'message' => 'Hello World!'
//     ]);
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('user/generate-password', [UserController::class, 'generatePassword']);

Route::middleware('auth:api')->group(function () {
    // User
    Route::get('user/me', [UserController::class, 'me']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    // Product
    Route::get('admin/product', [ProductController::class, 'indexAdmin']);
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/my-product', [ProductController::class, 'myProduct']);
});
