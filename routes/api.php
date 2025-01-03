<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MovieCategoryController;
use App\Http\Controllers\UserController;



// API Routes cho movies
Route::prefix('movies')->group(function () {
    Route::get('/all', [MovieController::class, 'index']);         // Lấy danh sách phim
    Route::get('/findId/{id}', [MovieController::class, 'show']);      // Lấy chi tiết phim
    Route::post('/create', [MovieController::class, 'store']);        // Tạo mới phim
    Route::put('/update/{id}', [MovieController::class, 'update']);    // Cập nhật thông tin phim
    Route::delete('delete/{id}', [MovieController::class, 'destroy']);// Xóa phim
});

// API Routes cho categories
Route::prefix('categories')->group(function () {
    Route::get('/all', [CategoryController::class, 'index']);         // Lấy danh sách danh mục
    Route::get('/findId/{id}', [CategoryController::class, 'show']);      // Lấy chi tiết danh mục
    Route::post('/create', [CategoryController::class, 'store']);        // Tạo mới danh mục
    Route::put('/update/{id}', [CategoryController::class, 'update']);    // Cập nhật danh mục
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);// Xóa danh mục
});

// API Routes cho history
Route::prefix('history')->group(function () {
    Route::get('/all', [HistoryController::class, 'index']);          // Lấy danh sách lịch sử
    Route::get('/findId/{id}', [HistoryController::class, 'show']);       // Lấy chi tiết lịch sử
    Route::post('/create', [HistoryController::class, 'store']);         // Tạo mới lịch sử
    Route::delete('/delete/{id}', [HistoryController::class, 'destroy']); // Xóa lịch sử
});
// API Routes cho favorites
Route::prefix('favorites')->group(function () {
    Route::get('/all', [FavoriteController::class, 'index']);          // Lấy danh sách yêu thích
    Route::get('/findId/{id}', [FavoriteController::class, 'show']);      // Lấy chi tiết yêu thích
    Route::post('/create', [FavoriteController::class, 'store']);        // Tạo mới yêu thích
    Route::delete('/delete/{id}', [FavoriteController::class, 'destroy']); // Xóa yêu thích
});

// API Routes cho users
Route::prefix('users')->group(function () {
    Route::get('/all', [UserController::class, 'index']);              // Lấy danh sách người dùng
    Route::get('/findId/{id}', [UserController::class, 'show']);        // Lấy chi tiết người dùng
    Route::post('/login', [UserController::class, 'login']);      //Login
    Route::post('/create', [UserController::class, 'store']);          // Tạo mới người dùng
    Route::put('/update/{id}', [UserController::class, 'update']);      // Cập nhật thông tin người dùng
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);  // Xóa người dùng
});

// API Routes cho movie categories
Route::prefix('movie-categories')->group(function () {
    Route::get('/all', [MovieCategoryController::class, 'index']);           // Lấy danh sách movie categories
    Route::get('/findId/{id}', [MovieCategoryController::class, 'show']);     // Lấy chi tiết movie category
    Route::post('/create', [MovieCategoryController::class, 'store']);        // Tạo mới movie category
    Route::put('/update/{id}', [MovieCategoryController::class, 'update']);   // Cập nhật movie category
    Route::delete('/delete/{id}', [MovieCategoryController::class, 'destroy']); // Xóa movie category
});
