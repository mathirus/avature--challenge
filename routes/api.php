<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('jobs', [JobController::class, 'search']);
Route::get('jobs/{id}', [JobController::class, 'show']);
Route::put('jobs/{id}', [JobController::class, 'update']);
Route::post('jobs', [JobController::class, 'store']);

Route::post('subscriptions', [SubscriptionController::class, 'store']);

