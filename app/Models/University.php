<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = "universities";
    protected $primaryKey = "uni_id";
    

    public function locations(){
       return  $this->hasMany(Location::class,"Location_id","uni_id");
    }
    public function rooms(){
        return  $this->hasMany(Room::class,"Room_no","uni_id");
     }
    use HasFactory;
}
