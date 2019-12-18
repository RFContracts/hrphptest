<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $model = DB::table('products')->orderBy('name')->paginate(25);
        return view('product.index', [
            'model' => $model
        ]);
    }
}