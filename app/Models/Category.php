<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function location(){
       return $this->hasMany(Location::class,'category_id');
    }

    public function room(){
        return $this->hasMany(Room::class,'category_id');
     }
    
    use HasFactory;
}
