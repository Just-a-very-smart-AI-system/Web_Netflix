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
        // foreach ($users as $user) {
        //     if (!Hash::needsRehash($user->password)) {
        //         // Mã hóa lại nếu mật khẩu chưa dùng Bcrypt
        //         $user->password = Hash::make($user->password);
        //         $user->save();
        //     }
        // }
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
            return response()->json(['message' => 'User name or email already exists'], 409); // Mã HTTP 409: Conflict
        }
    
        // Tạo User mới
        $newUser = User::create($validatedData);
    
        if (!$newUser) {
            return response()->json(['message' => 'Failed to create User'], 500);
        }
    
        return response()->json(['message' => 'User created successfully', 'newUser' => $newUser], 201);
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
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($validatedData['password'] !== $user->password) {
            return response()->json(['message' => 'Invalid password'], 401);
        }

        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }
}
