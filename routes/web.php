<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.category');
// });

// category route

Route::get('/', [CategoryController::class, 'categoryPage']);
Route::post('/create-category', [CategoryController::class, 'createCategory']);
Route::get('/all-category-list', [CategoryController::class, 'allCategory']);
Route::post('/delete-category', [CategoryController::class, 'deleteCategory']);
Route::post('/category-by-id', [CategoryController::class, 'categoryById']);
Route::post('/update-category', [CategoryController::class, 'updateCategory']);


// product route
Route::get('/product', [ProductController::class, 'productPage']);
Route::get('/all-product-list', [ProductController::class, 'allProduct']);
Route::post('/create-product', [ProductController::class, 'createProduct']);
Route::post('/delete-product', [ProductController::class, 'deleteProduct']);
Route::post('/product-by-id', [ProductController::class, 'productById']);
