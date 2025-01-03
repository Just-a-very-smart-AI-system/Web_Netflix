<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    // Hiển thị danh sách tất cả các danh mục
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }

    // Hiển thị chi tiết một danh mục
    public function show($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    // Tạo mới một danh mục
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Categories::create($validatedData);

        if (!$category) {
            return response()->json(['message' => 'Failed to create category'], 500);
        }

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }

    // Cập nhật thông tin một danh mục
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:50',
        ]);

        $category->update($validatedData);

        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    // Xóa một danh mục
    public function destroy($id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
