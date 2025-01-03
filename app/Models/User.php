<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user'; 
    public $timestamps = false;

    protected $fillable = [
        'user_name',
        'password',
        'email',
    ];

    // Quan hệ với bảng favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    // Quan hệ với bảng histories
    public function histories()
    {
        return $this->hasMany(History::class, 'user_id');
    }
}
