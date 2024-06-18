<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id');
    }

    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genres','movie_id','genre_id')->withTimestamps();
    }

    public function movie_category(){
        return $this->belongsToMany(Category::class,'movie__categories','movie_id','category_id')->withTimestamps();
    }


    //1 phim có nhiều tập
    public function practice(){
        return $this->hasMany(Episode::class);
    }

    


    
}
