<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function showKatalog()
    {
        $products = Product::with('category')->latest()->get();
        return view('katalog', compact('products'));
    }
}
