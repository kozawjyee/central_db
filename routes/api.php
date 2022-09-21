<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailsController;
use App\Http\Controllers\SalesPersonController;
use App\Http\Controllers\SalesPriceController;

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

Route::get('customers', [CustomerController::class, 'index']);

Route::get('item' , [ItemController::class , 'index']);
Route::get('itemDetails', [ItemDetailsController::class , 'index']);
Route::get('salesPerson' , [SalesPersonController::class , 'index']);
Route::get('salesPrice' , [SalesPriceController::class , 'index']);