<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_activities', function (Blueprint $table) {
            $table->foreignId("id")->nullable()->references('Room_no')->on('rooms')->cascadeOnUpdate()->nullOnDelete();
            $table->string("Type");
            $table->string("Change");
            $table->timestamps();
            
           
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_activities');
    }
}
