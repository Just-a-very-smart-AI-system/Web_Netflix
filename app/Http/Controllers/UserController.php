<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Lấy danh sách người dùng
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Lấy chi tiết người dùng theo ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // Tạo người dùng mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:50',
            'password'  => 'required|string|max:50',
            'email'     => 'required|string|max:50',
        ]);
    
        // Kiểm tra user_name hoặc email đã tồn tại
        $existingUser = User::where('user_name', $validatedData['user_name'])
                            ->orWhere('email', $validatedData['email'])
                            ->first();
    
        if ($existingUser) {
            return response()->json(['error' => 'User name or email already exists'], 409);
        }
    
        // Hash password trước khi lưu
        $validatedData['password'] = Hash::make($validatedData['password']);
    
        // Tạo User mới
        $newUser = User::create($validatedData);
    
        if (!$newUser) {
            return response()->json(['error' => 'Failed to create User'], 500);
        }
        return response()->json(['message' => 'User created successfully']);
    }
    
    // Xóa người dùng theo ID
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('user_name', $validatedData['username'])
                    ->orWhere('email', $validatedData['username'])
                    ->orWhere('email', $validatedData['password'])
                    ->first();
        if (!$user) {
            return response()->json(['error' => 'User name or email not found'], 404);
        }
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json($user);
    }
}