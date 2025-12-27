<?php

use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Province API Routes
|--------------------------------------------------------------------------
|
| Endpoints:
| GET    /api/provinsi        - List all provinces
| POST   /api/provinsi        - Create new province
| GET    /api/provinsi/{id}   - Show province detail
| PUT    /api/provinsi/{id}   - Update province
| DELETE /api/provinsi/{id}   - Delete province
|
*/
Route::apiResource('provinsi', ProvinceController::class);
