<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_downloads', function (Blueprint $table) {
        
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
        Schema::dropIfExists('user_downloads');
             
    }
}
