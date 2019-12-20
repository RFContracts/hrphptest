<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $model = Product::orderBy('name')->paginate(25);
        return view('product.index', [
            'model' => $model
        ]);
    }

    public function ajaxPrice(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'price' => 'required|integer'
        ]);
        Product::where(['id' => request('id')])->update(['price' => request('price')]);
    }
}