<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Cache;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtController
{
    private static $key = "b762ee4db4daa29d7b52d34632cb7a247fcfb121bd38d9c41039b9c046f3789b500bc4919620134a08317231d29ed51fb806cd12c1b45d97e71e0be94e84c9e2d4fa4e506347b6b6704cd2792da739c70e8c9413c66def0970d09183a79781d9473be0d362bc43a450c03173b0f80d4ff0cb45e06844be453c2143c4a2beaa85";

    // Tạo token
    public static function createToken($user)
    {
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600, 
            'sub' => $user->id,
            'user_name' => $user->user_name,
            'email' => $user->email
        ];

        return JWT::encode($payload, self::$key, 'HS256');
    }

    // Giải mã token
    public static function decodeToken($token)
    {
        try {
            return JWT::decode($token, new Key(self::$key, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
    // public static function blacklistToken($token)
    // {
    //     $decoded = self::decodeToken($token);
    //     if (!$decoded) {
    //         return false; // Token không hợp lệ
    //     }

    //     $expirationTime = $decoded->exp - time(); // Tính thời gian hết hạn còn lại

    //     // Lưu token vào Redis với thời gian hết hạn tương ứng
    //     Cache::put('blacklist_' . $token, true, $expirationTime);

    //     return true;
    // }
    // Hàm kiểm tra token có trong blacklist không
    public static function isTokenBlacklisted($token)
    {
        return Cache::has('blacklist_' . $token);
    }
}
