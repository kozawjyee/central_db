<?php

namespace App\Http\Controllers;

use App\Models\ItemDetails;
use Illuminate\Http\Request;

class ItemDetailsController extends Controller
{
    //
    public function index()
    {
        $data = ItemDetails::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
