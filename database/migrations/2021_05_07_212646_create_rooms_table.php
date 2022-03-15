<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id("Room_no")->unique();
            $table->mediumText("Desc");
            $table->string("Floor");
            $table->foreignId("location_id")->references('Location_id')->on('locations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("room_name")->nullable();
            //$table->string("occupied_by");
            $table->foreignId("category_id")->nullable()->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("uni_id")->references('uni_id')->on('universities')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('rooms');
    }
}
