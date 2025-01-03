<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    // Hiển thị danh sách lịch sử
    public function index()
    {
        $history = History::all();
        return response()->json($history);
    }

    // Hiển thị chi tiết một lịch sử
    public function show($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message' => 'History not found'], 404);
        }

        return response()->json($history);
    }

    // Tạo mới một lịch sử
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'user_id' => 'required|integer|exists:user,id',
        ]);

        $history = History::create($validatedData);

        if (!$history) {
            return response()->json(['message' => 'Failed to create history'], 500);
        }

        return response()->json(['message' => 'History created successfully', 'history' => $history], 201);
    }

    // Xóa một lịch sử
    public function destroy($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message' => 'History not found'], 404);
        }

        $history->delete();

        return response()->json(['message' => 'History deleted successfully']);
    }
}
