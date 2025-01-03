<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movies::all();
        return response()->json($movies);
    }

    // Hiển thị chi tiết một phim
    public function show($id)
    {
        $movie = Movies::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }

    // Tạo mới một phim
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'url' => 'required|string|max:100',
        ]);

        $movie = Movies::create($validatedData);

        if (!$movie) {
            return response()->json(['message' => 'Failed to create movie'], 500);
        }

        return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
    }

    // Cập nhật thông tin một phim
    public function update(Request $request, $id)
    {
        $movie = Movies::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:50',
            'url' => 'sometimes|required|string|max:100',
        ]);

        $movie->update($validatedData);

        return response()->json(['message' => 'Movie updated successfully', 'movie' => $movie]);
    }

    // Xóa một phim
    public function destroy($id)
    {
        $movie = Movies::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }
}
