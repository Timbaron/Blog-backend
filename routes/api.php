<?php

use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/post/{slug}', [PostController::class, 'show']);
Route::put('/post/{post}', [PostController::class, 'update']);
Route::delete('/post', [PostController::class, 'destroy']);


// Fallback ROUTE is route is not found
Route::fallback(function () {
    return response()->json([
        'message' => 'Page not found.',
    ], 404);
});
