<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransferLines;

class StockTransferLinesController extends Controller
{
    public function index()
    {
        $data = StockTransferLines::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
