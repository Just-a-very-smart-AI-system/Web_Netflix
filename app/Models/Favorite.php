<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

Class Favorite extends Model{
    protected $table = "favorite";
    public $timestamps = false;

    protected $fillable = [
        'movie_id',
        'user_id'
    ];
    public function movies(){
        return $this->belongsTo(Movies::class, "movie_id");
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

}