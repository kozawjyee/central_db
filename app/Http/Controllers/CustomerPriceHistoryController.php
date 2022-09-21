<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPriceHistory;

class CustomerPriceHistoryController extends Controller
{
    public function index()
    {
        $data = CustomerPriceHistory::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
