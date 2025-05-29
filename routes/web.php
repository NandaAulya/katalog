<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');


Route::controller(HomeController::class)->group(function () {
    Route::get('/katalog', 'showKatalog')->name('katalog');
    Route::get('/catalog', 'catalogFilter')->name('catalogFilter');
});

// Route::get('/katalog', function () {
//     return view('katalog');
// });

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'dashboard')->name('adminDashboard');
    Route::get('/admin/products', 'productIndex')->name('admin.listProduct');
    Route::get('/admin/products/create', 'productCreate')->name('admin.createProduct');
    Route::post('/admin/products', 'productStore')->name('admin.storeProduct');
    Route::get('/admin/products/{product}/edit', 'productEdit')->name('admin.editProduct');
    Route::put('/admin/products/{product}', 'productUpdate')->name('admin.updateProduct');
    Route::delete('/admin/products/{product}', 'productDestroy')->name('admin.destroyProduct');
    Route::get('/admin/products/search', 'productSearch')->name('admin.searchProduct');
    Route::get('/admin/products/filter', 'productFilter')->name('admin.productFilter');
});

// Category CRUD (bisa dimasukkan dalam grup admin)
Route::get('/admin/categories', [AdminController::class, 'categoryIndex'])->name('admin.listCategory');
Route::get('/admin/categories/create', [AdminController::class, 'categoryCreate'])->name('admin.createCategory');
Route::post('/admin/categories', [AdminController::class, 'categoryStore'])->name('admin.storeCategory');
Route::delete('/admin/category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.destroyCategory');




