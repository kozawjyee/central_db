<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index()
    {
        $data = Item::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
