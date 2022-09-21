<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransfer;

class StockTransferController extends Controller
{
    public function index()
    {
        $data = StockTransfer::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
