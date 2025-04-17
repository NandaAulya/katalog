<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function showKatalog()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('katalog', compact('products', 'categories'));
    }

    public function catalogFilter(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('katalog', compact('products', 'categories'));
    }
}
