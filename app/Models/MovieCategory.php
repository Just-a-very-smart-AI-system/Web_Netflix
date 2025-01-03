<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieCategory extends Model
{
    protected $table = 'movie_category';
    public $timestamps = false;

    protected $fillable = [
        'movie_id',
        'category_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'category_id');
    }

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'movie_id');
    }

}