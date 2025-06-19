<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalKategori = Category::count();

        // Hitung penambahan bulan ini
        $produkBulanIni = Product::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $kategoriBulanIni = Category::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('adminDashboard', compact('totalProduk', 'totalKategori', 'produkBulanIni', 'kategoriBulanIni'));
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
            'gambar.*' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.createProduct')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->fill($request->only(['nama', 'harga', 'stok', 'category_id', 'deskripsi']));
        $product->save();

        // Upload multiple images
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $imageName = time() . '-' . uniqid() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
            }
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // fix nama field
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.editProduct', $product->id)->withInput()->withErrors($validator);
        }

        $product->update($request->only(['nama', 'harga', 'stok', 'category_id', 'deskripsi']));

        // Upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imageName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $imageName);

                // Simpan ke tabel product_images
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.listProduct', $product->id)->with('success', 'Produk berhasil diperbarui!');
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
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        $imagePath = public_path('uploads/products/' . $image->image);

        // Cek apakah file benar-benar ada sebelum dihapus
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus data dari database
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($product->thumbnail && $product->thumbnail->image) {
            $thumbnailPath = public_path('uploads/products/' . $product->thumbnail->image);
            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }

            // Hapus relasi thumbnail dari DB jika perlu
            $product->thumbnail->delete();
        }

        // Hapus semua gambar tambahan
        foreach ($product->images as $image) {
            $imagePath = public_path('uploads/products/' . $image->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image->delete();
        }

        // Hapus produk dari DB
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
