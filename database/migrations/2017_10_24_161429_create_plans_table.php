<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('plans', function (Blueprint $table) {
        
        $table->bigIncrements('id');
        $table->string('plan_title');
        $table->float('amount',8,2)->default(0.00);
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
        //
        Schema::dropIfExists('plans');
             
    }
}
