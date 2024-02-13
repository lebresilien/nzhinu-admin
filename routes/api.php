<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;

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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/orders', [OrderController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum' ],  function($route) {
    $route->post('logout', [AuthController::class, 'logout']);
});


Route::get('/products/{lang}', [ProductController::class, 'listProducts']);
Route::get('/categories/{lang}/{slug}', [ProductController::class, 'categories']);
Route::get('/products/{lang}/{slug}', [ProductController::class, 'product']);