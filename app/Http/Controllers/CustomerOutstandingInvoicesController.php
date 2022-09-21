<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOutstandingInvoices;

class CustomerOutstandingInvoicesController extends Controller
{
    public function index(){
        $data = CustomerOutstandingInvoices::all();

        return response()->json([
            'data' => $data
        ]);
    }
}
