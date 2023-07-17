<?php

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


Route::post('/reserve/table', [\App\Http\Controllers\ReserveTableController::class, 'reserveTable']);
Route::post('/reserve/table/waitingList', [\App\Http\Controllers\ReserveTableController::class, 'reserveTableWithWaitingList']);
Route::get('/menu/items', [\App\Http\Controllers\MealController::class, 'menuItems']);
Route::post('/make/order', [\App\Http\Controllers\OrderController::class, 'makeOrder']);
Route::post('/checkout-and-print-invoice', [App\Http\Controllers\OrderController::class,'checkoutAndPrintInvoice']);
