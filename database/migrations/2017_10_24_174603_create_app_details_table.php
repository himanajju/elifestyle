<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('app_details', function (Blueprint $table) {
        
        $table->bigIncrements('id');
        $table->biginteger('app_id')
                    ->foreign()
                    ->references('id')
                    ->on('apps')
                    ->onDelete('cascade');
        $table->string('version');
        $table->string('apk_path');
        $table->string('developer');
        $table->string('app_package');
        $table->enum('is_active',[1,0])
                    ->commets('1 for active user')
                    ->default(1);
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
        Schema::dropIfExists('app_details');
             
    }
}
