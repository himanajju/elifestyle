<?php

use Illuminate\Database\Seeder;

class ApkPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('apk_permissions')->insert(['id'=>1,
        			'permission_title'=>"Calender",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>2,
        			'permission_title'=>"Camera",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>3,
        			'permission_title'=>"Contacts",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>4,
        			'permission_title'=>"Location",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>5,
        			'permission_title'=>"Microphone",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>6,
        			'permission_title'=>"Phone",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>7,
        			'permission_title'=>"Sensors",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>8,
        			'permission_title'=>"SMS",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
       DB::table('apk_permissions')->insert(['id'=>9,
        			'permission_title'=>"Storage",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
        
    }
}
