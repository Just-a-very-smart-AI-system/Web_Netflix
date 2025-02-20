<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('log_in');
});
Route::get('/home', function (Request $request) {
    // Lấy user_id từ query string
    $user_id = $request->query('user_id');

    // Kiểm tra nếu không có user_id
    if (!$user_id) {
        return redirect('/')->with('error', 'User ID không hợp lệ.');
    }

    // Kiểm tra nếu user_id không hợp lệ
    if (!is_numeric($user_id)) {
        return redirect('/')->with('error', 'User ID phải là một số.');
    }
    // Lưu user_id vào session
    session(['user_id' => $user_id]);
    
    return view('home', compact('user_id'));
});

