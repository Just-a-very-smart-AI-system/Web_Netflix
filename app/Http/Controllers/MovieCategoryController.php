<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieCategory;

class MovieCategoryController extends Controller
{
    public function index(){
        $movie_category = MovieCategory::all();
        return response()->json($movie_category);
    }

    public function show($id){
        $movie_category = MovieCategory::find($id);
        if(!$movie_category){
            return response()->json(['message' => 'Movie-Category not found'], 404);
        }
        return response()->json($movie_category);
    }

    public function store($request){
        $movie_category = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $new_movie = MovieCategory::create($movie_category);

        if(!$new_movie){
            return response()->json(['message' => 'Failed to create Movie-Category'], 500);
        }
        return response()->json($new_movie);
    }
    public function destroy($id){
        $movie_category = MovieCategory::find($id);
        if(!$movie_category){
            return response()->json(['message' => 'Movie-Category not found'], 404);
        }
        $movie_category->delete();

        return response()->json(['message' => 'MovieCategory deleted successfully']);
    }
}
