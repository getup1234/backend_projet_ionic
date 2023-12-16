<?php

use App\Http\Controllers\AnnoncesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', function (Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('token-name')->plainTextToken;
        //dd($token);
        return response()->json(['token' => $token]);
    }

    throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.'],
    ]);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/annonces', [AnnoncesController::class, 'index']);
    Route::get('/propres_annonces', [AnnoncesController::class, 'propres_annonces']);
    Route::get('/annonces/{id}', [AnnoncesController::class, 'show']);
    Route::post('/annonces', [AnnoncesController::class, 'store']);
    Route::put('/annonces/{id}', [AnnoncesController::class, 'update']);
    Route::delete('/annonces/{id}', [AnnoncesController::class, 'destroy']);
});


Route::get('/annonces1', [AnnoncesController::class, 'index']);
