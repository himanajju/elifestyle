<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
           Schema::create('users', function (Blueprint $table) {
        
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->biginteger('user_type_id')
                    ->foreign()
                    ->references('id')
                    ->on('usergroups')
                    ->onDelete('cascade');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->enum('sex',['male','female', 'trigender']);
            $table->date('dob')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('device_id')->nullable();
            $table->enum('is_active',[1,0])
                    ->commets('1 for active user')
                    ->default(1);
            $table->enum('is_plan',[1,0])
                    ->commets('1 for active user')
                    ->default(0);
            $table->timestamp('valid_till')->nullable();
            $table->enum('is_blocked',[1,0])
                    ->default(0)
                    ->commets('1 for blocked');
            $table->rememberToken();
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
             Schema::dropIfExists('users');

   
    }
}
