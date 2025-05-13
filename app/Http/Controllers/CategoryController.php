<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.listing', compact('category'));
    }

    public function add(Request $request)
    {
        $user = Category::create([
            'category' => $request->category,
            'status' => $request->status,
        ]);
        return response()->json(['success' => true, 'user' => $user]);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true]);
    }
    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    public function updatecategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->status = $request->status;
        $category->save();

        return response()->json(['message' => 'Updated successfully']);
    }
    public function subCategoryIndex()
    {
        $categoryDropdown = Category::all();
        $subcategory = SubCategory::with('category')->get();
        return view('category.subCategorylisting', compact('categoryDropdown', 'subcategory'));
    }
    public function addSubcategory(Request $request)
    {
        $subCategory = SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
            'status' => $request->status,
        ]);
        return response()->json(['success' => true, 'subCategory' => $subCategory]);
    }
    public function destroySubCategory($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true]);
    }
    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        return response()->json($subcategory);
    }
    public function updatesubcategory(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer',
            'sub_category' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $subcategory->update([
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'Subcategory updated successfully']);
    }
}
