<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SecretsController;
use App\Http\Controllers\Api\Users\RegisterController;
use App\Http\Controllers\Api\Users\SessionsController;

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/signin', [SessionsController::class, 'store'])->name('signin');
Route::delete('/signout', [SessionsController::class, 'destroy'])->name('signout');

Route::middleware('auth:api')->group(function () {
    Route::resource('contacts', ContactController::class, [
        'except' => ['create', 'edit']
    ]);
});

Route::middleware(['auth:api', 'validate-role:secretagent'])->group(function () {
    Route::get('/secrets', [SecretsController::class, 'index'])->name('secret');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Where are you?',
        'data'    => null
    ], 404);
})->name('api.fallback.404');
