<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    //
    public function index()
    {
        $data = SalesPerson::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
