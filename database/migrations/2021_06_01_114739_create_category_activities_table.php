<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_activities', function (Blueprint $table) {
            $table->foreignId("id")->nullable()->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('category_activities');
    }
}
