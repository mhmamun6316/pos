<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/',[AuthController::class,'index'])->name('index');
    Route::post('/login',[AuthController::class,'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('profile/view', [AuthController::class, 'ProfileView'])->name('profile.view');
    Route::post('profile/update', [AuthController::class, 'ProfileUpdate'])->name('profile.update');
    Route::get('password/change', [AuthController::class, 'ProfilePassword'])->name('password.change');
    Route::post('password/update', [AuthController::class, 'PasswordUpdate'])->name('password.update');
});

// users
Route::resource('users', UserController::class);
Route::post('users/update/{user_id}',[UserController::class,'update']);

// brands
Route::resource('brands',BrandController::class)->except(['show']);
Route::post('brands/update/{brand_id}',[BrandController::class,'update']);

// categories
Route::resource('categories',CategoryController::class)->except(['show']);
Route::post('categories/update/{category_id}',[CategoryController::class,'update']);

// sub-categories
Route::resource('sub/categories',SubCategoryController::class)->except(['show']);
Route::get('sub/categories',[SubCategoryController::class,'index'])->name('sub.categories.index');
Route::post('sub/categories',[SubCategoryController::class,'store'])->name('sub.categories.store');
Route::get('sub/categories/create',[SubCategoryController::class,'create'])->name('sub.categories.create');
Route::get('sub/categories/{sub_category_id}/edit',[SubCategoryController::class,'edit'])->name('sub.categories.edit');
Route::post('sub/categories/update/{sub_category_id}',[SubCategoryController::class,'update']);
Route::delete('sub/categories/{sub_category_id}',[SubCategoryController::class,'destroy']);

// products
Route::get('products/stock',[ProductController::class,'stockProduct'])->name('product.stock');
Route::resource('products',ProductController::class);
Route::get('products/get/all/{outlet?}/{brand?}/{category?}/{subcategory?}/{start_date?}/{to_date?}',[ProductController::class,'getAll']);
Route::post('products/update',[ProductController::class,'update'])->name('product.update');

// outlets
Route::resource('outlets',OutletController::class)->except(['show']);
Route::post('outlets/update/{outlets_id}',[OutletController::class,'update']);

// stock transfers
Route::post('stock/add/{product_id}',[StockTransferController::class,'stockAdd']);
Route::get('stock/transfers/all',[StockTransferController::class,'StockAll']);
Route::post('temporary/stock/delete/{id}',[StockTransferController::class,'StockDelete']);
Route::post('temporary/stock/increment/{id}',[StockTransferController::class,'StocIncrement']);
Route::resource('stock/transfers',StockTransferController::class);
Route::delete('stock/transfers/{id}',[StockTransferController::class,'destroy']);
Route::get('stock/transfers/accept/{id}',[StockTransferController::class,'stockAccept']);
Route::get('stock/transfers/complete/{id}',[StockTransferController::class,'stockComplete']);

// product sale
Route::resource('pos',PosController::class);
Route::post('add/to/pos/{id}',[PosController::class,'addToPos']);
Route::get('pos/increment/{id}',[PosController::class,'incrementPos']);
Route::get('pos/decrement/{id}',[PosController::class,'decrementPos']);
Route::get('pos/remove/{id}',[PosController::class,'removePos']);

// customers
Route::get('customers',[CustomerController::class,'index'])->name('customers');

// expenses category
Route::resource('expenses/category',ExpenseCategoryController::class);
// expenses
Route::resource('expenses',ExpenseController::class);

// sale
Route::get('sales/due',[SaleController::class,'salesDue'])->name('sales.due');
Route::post('sales/due',[SaleController::class,'salesDuePay']);
Route::resource('sales',SaleController::class);

// pdf print
Route::get('sale/pdf/{id}', [PosController::class, 'saleGenerate'])->name('sales.generate');
