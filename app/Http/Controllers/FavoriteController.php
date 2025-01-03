<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // Hiển thị danh sách lịch sử
    public function index()
    {
        $favorite = Favorite::all();
        return response()->json($favorite);
    }

    // Hiển thị chi tiết một lịch sử
    public function show($id)
    {
        $favorite = Favorite::find($id);

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        return response()->json($favorite);
    }

    // Tạo mới một lịch sử
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'user_id' => 'required|integer|exists:user,id',
        ]);

        $favorite = Favorite::create($validatedData);

        if (!$favorite) {
            return response()->json(['message' => 'Failed to create Favorite'], 500);
        }

        return response()->json(['message' => 'Favorite created successfully', 'history' => $favorite], 201);
    }

    // Xóa một lịch sử
    public function destroy($id)
    {
        $favorite = Favorite::find($id);

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite deleted successfully']);
    }
}
