<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Movies;

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

        return response()->json(['message' => 'Favorite created successfully', 'favorite' => $favorite], 201);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'user_id' => 'required|integer|exists:user,id',
        ]);

        // Tìm mục yêu thích dựa trên movie_id và user_id
        $favorite = Favorite::where('movie_id', $validatedData['movie_id'])
                            ->where('user_id', $validatedData['user_id'])
                            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite deleted successfully']);
    }


    

    public function findByUserId($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();
    
        if ($favorites->isEmpty()) {
            return response()->json(['message' => 'No favorites found for this user'], 404);
        }
    
        $movies = [];
        $movieController = new MovieController();
    
        foreach ($favorites as $favorite) {
            $movieResponse = $movieController->show($favorite->movie_id);
            if ($movieResponse->getStatusCode() === 200) {
                $movies[] = json_decode($movieResponse->getContent(), true);
            }
        }
    
        if (empty($movies)) {
            return response()->json(['message' => 'No movies found for this user'], 404);
        }
    
        return response()->json($movies);
    }
    

}
