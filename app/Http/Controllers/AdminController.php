<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('adminDashboard');
    }
    public function productIndex()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function productSearch(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->with('category')->paginate(10);
        $categories = Category::all();

        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function productFilter(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->with('category')->paginate(10);
        $categories = Category::all(); // ini penting!

        return view('admin.listProduct', compact('products', 'categories'));
    }

    public function productCreate()
    {
        $categories = Category::all();
        return view('admin.createProduct', compact('categories'));
    }

    public function productStore(Request $request)
    {
        $rules = [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.createProduct')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->fill($request->only(['nama', 'harga', 'stok', 'category_id', 'deskripsi']));
        $product->save();

        if ($request->hasFile('gambar')) {
            $gambar = $request->gambar;
            $imageName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/products'), $imageName);
            $product->gambar = $imageName;
            $product->save();
        }

        return redirect()->route('admin.listProduct')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.editProduct', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'nama' => 'required|min:5',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.editProduct', $product->id)->withInput()->withErrors($validator);
        }

        $product->fill($request->only(['nama', 'harga', 'stok', 'category_id', 'deskripsi']));
        $product->save();

        if ($request->hasFile('gambar')) {
            File::delete(public_path('uploads/products/' . $product->image_url));

            $gambar = $request->gambar;
            $imageName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/products'), $imageName);

            $product->gambar = $imageName;
            $product->save();
        }

        return redirect()->route('admin.listProduct')->with('success', 'Produk berhasil diperbarui!');
    }

    public function categoryIndex()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.listCategory', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('admin.createCategory');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.listCategory')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path('uploads/products/' . $product->image_url));
        $product->delete();

        return redirect()->route('admin.listProduct')->with('success', 'Produk berhasil dihapus!');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek relasi jika diperlukan, misalnya apakah ada produk yang terhubung
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
        }

        $category->delete();

        return redirect()->route('admin.listCategory')->with('success', 'Kategori berhasil dihapus!');
    }
}
