<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/hello", function () {
    return "hello";
});

use App\Http\Controllers\Api\PostController;
Route::apiResource('posts', PostController::class);

# Authenticate API Methods
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    if ($user->tokens->count() < 1) {
        return $user->createToken($request->device_name)->plainTextToken;
    }
    return response()->json(['message' => 'Already Logged In, Please Logout First from other device'], 422);

});


# Logout
Route::post("/sanctum/logout", function () {
    $user = Auth::user();
    # Delete All Tokens
    $user->tokens()->delete();
    # Delete Current Token
    // $user->currentAccessToken()->delete();
    return response()->json(["message" => "logged out successfully"], 200);
})->middleware("auth:sanctum");