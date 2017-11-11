<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
        
        $table->bigIncrements('id');
        $table->biginteger('plan_id')
                    ->foreign()
                    ->references('id')
                    ->on('plans')
                    ->onDelete('cascade');
        $table->biginteger('user_id')
                    ->foreign()
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        $table->biginteger('subscription_months_id')
                    ->foreign()
                    ->references('id')
                    ->on('subscription_months')
                    ->onDelete('cascade');
        $table->timestamp('valid_till');
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
        Schema::dropIfExists('user_plans');
    }
}
