<?php

use Illuminate\Database\Seeder;

class UsergroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usergroups')->insert(['id'=>1,
        			'group_title'=>"ADMIN",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
        DB::table('usergroups')->insert(['id'=>2,
        			'group_title'=>"CUSTOMER",
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
    }
}
