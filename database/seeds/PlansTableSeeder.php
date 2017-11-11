<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('plans')->insert(['id'=>1,
        			'plan_title'=>"Free",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       
        DB::table('plans')->insert(['id'=>2,
        			'plan_title'=>"Silver",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       
        DB::table('plans')->insert(['id'=>3,
        			'plan_title'=>"Gold",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       
        DB::table('plans')->insert(['id'=>4,
        			'plan_title'=>"Platinum",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       
    }
}
