<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('category.listing');
// });

//------------------------Category Routes--------------->
Route::get('/', [CategoryController::class, 'index'])->name('category.index');
Route::get('category', [CategoryController::class, 'index'])->name('category.index');
Route::post('add', [CategoryController::class, 'add'])->name('category.add');
Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/categoryedit/{id}', [CategoryController::class, 'showCategory']);
Route::put('/categoryupdate/{id}', [CategoryController::class, 'updatecategory']);


// <-----------------------Sub-Category Route----------------------->

Route::get('subcategory', [CategoryController::class, 'subCategoryIndex'])->name('add.subcategory');
Route::post('createsubcategory', [CategoryController::class, 'addSubcategory'])->name('create.subcategory');
Route::delete('destroysubcategory/{id}', [CategoryController::class, 'destroySubCategory'])->name('subcategory.destroy');
Route::get('/subcategories/{id}', action: [CategoryController::class, 'show']);
Route::put('/subcategoryupdate/{id}', [CategoryController::class, 'updatesubcategory']);




//------------------------Size Routes--------------->
Route::get('/addsize', [ProductController::class, 'index'])->name('add.size');
Route::post('/createsize', [ProductController::class, 'createSize'])->name('create.size');
Route::delete('destroysize/{id}', [ProductController::class, 'destroySize'])->name('size.destroy');
Route::get('/sizes/{id}', action: [ProductController::class, 'show']);
Route::put('/sizeupdate/{id}', [ProductController::class, 'updateSize']);
Route::get('/stock', action: [ProductController::class, 'remainingStock'])->name('remaining.stock');



//------------------------Product Routes--------------->
Route::get('/addproduct', [ProductController::class, 'indexproduct'])->name('add.product');
Route::post('/createproduct', [ProductController::class, 'createProduct'])->name('create.product');
Route::delete('destroyproduct/{id}', [ProductController::class, 'destroyProduct'])->name('product.destroy');
Route::get('/product/{id}', action: [ProductController::class, 'showProduct']);
Route::put('/productupdate/{id}', [ProductController::class, 'updateProduct']);




