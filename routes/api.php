<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('professionals', [ProfessionalController::class, 'index']);
Route::post('professionals', [ProfessionalController::class, 'store']);
Route::put('professionals/{id}', [ProfessionalController::class, 'update']);
Route::delete('professionals/{id}', [ProfessionalController::class, 'destroy']);
Route::get('professionals/{id}', [ProfessionalController::class, 'show']);
