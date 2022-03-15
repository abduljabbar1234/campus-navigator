<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "locations";
    protected $primaryKey = "Location_id";
    public $timestamps =false;
    public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }

    public function university(){
      return $this->belongsTo(University::class,'uni_id','Locationid');
   }

    public function room(){
       return  $this->hasMany(Room::class,'location_id',"Location_id");
    }
    use HasFactory;
}
