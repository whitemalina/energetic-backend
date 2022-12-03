<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
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


Route::post('/login', [AuthController::class, 'login']);
Route::post('/createuser', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {
    //Route::post('/createuser', [AuthController::class, 'register']);

    Route::get('{id}/objects', [PostController::class, 'byProject']);
    Route::get('/objects', [PostController::class, 'index']);

    Route::get('/organization', [OrganizationController::class, 'index']);
    Route::post('/organization', [OrganizationController::class, 'store']);
    Route::get('/objects/{id}', [PostController::class, 'show']);
    Route::post('/objects', [PostController::class, 'store']);

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('{id}/projects', [ProjectController::class, 'forOrganization']);
});
