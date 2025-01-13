<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::all();
        return response()->json($history);
    }

    public function show($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message' => 'History not found'], 404);
        }

        return response()->json($history);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'user_id' => 'required|integer|exists:user,id',
        ]);

        // Kiểm tra xem bản ghi đã tồn tại chưa
        $exists = History::where('movie_id', $validatedData['movie_id'])
            ->where('user_id', $validatedData['user_id'])
            ->delete();


        // Nếu chưa tồn tại, thêm mới
        $history = History::create($validatedData);

        if (!$history) {
            return response()->json(['message' => 'Failed to create history'], 500);
        }

        return response()->json([
            'message' => 'History created successfully',
            'history' => $history
        ], 201);
    }

    public function destroy($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json(['message' => 'History not found'], 404);
        }

        $history->delete();

        return response()->json(['message' => 'History deleted successfully']);
    }

    public function findByUserId($user_id)
    {
        $histories = History::where('user_id', $user_id)->get();
    
        if ($histories->isEmpty()) {
            return response()->json(['message' => 'No histories found for this user'], 404);
        }
    
        $movies = [];
        $movieController = new MovieController();
    
        foreach ($histories as $history) {
            $movieResponse = $movieController->show($history->movie_id);
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
