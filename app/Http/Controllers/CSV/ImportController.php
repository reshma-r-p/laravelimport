<?php

namespace App\Http\Controllers\CSV;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|mimes:csv,txt',
        ]);
        $import = Excel::import(new ProductsImport,request()->file('products'));
        return response()->json([
        'message' => 'Products imported successfully!'
        ], 201);
    }
}
