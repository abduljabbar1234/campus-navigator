<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";
    protected $primaryKey = "Room_no";

    public function location(){
        return $this->belongsTo(Location::class,'location_id','Location_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
     }
     public function university(){
        return $this->belongsTo(University::class,'uni_id','Locationid');
     }
    use HasFactory;
}
