<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id("Location_id")->unique();
            $table->string("Name");
            $table->string("Latitude");
            $table->string("Longitude");
            $table->foreignId("category_id")->nullable()->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("uni_id")->references('uni_id')->on('universities')->cascadeOnDelete()->cascadeOnUpdate();
        });
        
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
