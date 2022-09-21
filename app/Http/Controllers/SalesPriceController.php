<?php

namespace App\Http\Controllers;

use App\Models\SalesPrice;
use Illuminate\Http\Request;

class SalesPriceController extends Controller
{
    //
    public function index()
    {
        $data = SalesPrice::all();
        
        return response()->json([
            'data' => $data
        ]);
    }
}
