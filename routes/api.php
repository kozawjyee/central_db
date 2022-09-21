<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOutstandingInvoicesController;
use App\Http\Controllers\CustomerPriceHistoryController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\StockTransferLinesController;

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
Route::get('customerOustandingInvoices', [CustomerOutstandingInvoicesController::class, 'index']);
Route::get('customerPriceHistory', [CustomerPriceHistoryController::class, 'index']);
Route::get('stockTransfer', [StockTransferController::class, 'index']);
Route::get('stockTransferLines', [StockTransferLines::class, 'index']);
