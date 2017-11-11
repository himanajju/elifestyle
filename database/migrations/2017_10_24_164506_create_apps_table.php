<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('apps', function (Blueprint $table) {
        
        $table->bigIncrements('id');
        $table->string('title');
        $table->longText('description')->nullable();
        $table->string('logo_path')->nullable();
        $table->biginteger('plan_id')
                    ->foreign()
                    ->references('id')
                    ->on('plans')
                    ->onDelete('cascade');
        $table->biginteger('category_id')
                    ->foreign()
                    ->references('id')
                    ->on('app_categories')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('apps');
             
    }
}
