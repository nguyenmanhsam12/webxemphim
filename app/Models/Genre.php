<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status','slug'];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genres','movie_id','genre_id');
    }
}
