<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function index()
    {
        $categoryDropdown = Category::all();
        $subCategoryDropdown = SubCategory::all();
        $size = Size::with('category', 'subcategory')->get();
        return view('product.size', compact('categoryDropdown', 'subCategoryDropdown', 'size'));
    }

    public function createSize(Request $request)
    {
        $size = Size::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'size' => $request->size,
            'min' => $request->min,
            'max' => $request->max
        ]);
        return response()->json(['success' => true, 'size' => $size]);
    }
    public function destroySize($id)
    {
        $category = Size::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true]);
    }
    public function show($id)
    {
        $subcategory = Size::findOrFail($id);
        return response()->json($subcategory);
    }
    public function updateSize(Request $request, $id)
    {
        $size = Size::findOrFail($id);
        $size->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'size' => $request->size,
            'min' => $request->min,
            'max' => $request->max,
        ]);

        return response()->json(['message' => 'Size updated successfully']);
    }
    public function indexproduct()
    {
        $categoryDropdown = Category::all();
        $subCategoryDropdown = SubCategory::all();
        $sizeDropdown = Size::all();
        $product = ProductModel::with('category', 'subcategory', 'size')->get();
        return view('product.listing', compact('categoryDropdown', 'subCategoryDropdown', 'sizeDropdown', 'product'));
    }
    public function createProduct(Request $request)
    {
        $product = ProductModel::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'size_id' => $request->size_id,
            'status' => $request->status,
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json(['success' => true, 'product' => $product]);
    }
    public function destroyProduct($id)
    {
        $category = ProductModel::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true]);
    }
    public function showProduct($id)
    {
        $product = ProductModel::findOrFail($id);
        return response()->json($product);
    }
    public function updateProduct(Request $request, $id)
    {
        $product = ProductModel::findOrFail($id);
        $product->update([
            'size_id' => $request->size_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);
        return response()->json(['message' => 'Product updated successfully']);
    }
    public function remainingStock()
    {
        $product = ProductModel::where('status', 1)->with('category', 'subcategory', 'size')->get();
        return view('product.remainigStock', compact('product'));
    }

}
