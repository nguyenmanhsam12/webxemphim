<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','status','slug'];
    
    public function movie(){
        return $this->hasMany(Movie::class)->orderBy('id','desc');
    }
}
