<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_activities', function (Blueprint $table) {
            $table->foreignId("id")->nullable()->references('Location_id')->on('locations')->nullOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('location_activities');
    }
}
