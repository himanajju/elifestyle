<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('app_user_rates', function (Blueprint $table) {
        
        $table->bigIncrements('id');
        $table->biginteger('app_id')
                    ->foreign()
                    ->references('id')
                    ->on('apps')
                    ->onDelete('cascade');
        $table->biginteger('user_id')
                    ->foreign()
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        $table->float('rating',2,1);
        $table->string('comments');
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
        Schema::dropIfExists('app_user_rates');
             
    }
}
