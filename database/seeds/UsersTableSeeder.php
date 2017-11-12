<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert(['id'=>1,
        			'email'=>"admin@life.com",
        			'password'=>'qwerty123',
        			'user_type_id'=>'1',
        			'fname'=>'Gqira',
        			'lname'=>'Kabane',
        			'sex'=>'male',
        			'contact_no'=>'9876543210',
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
        DB::table('users')->insert(['id'=>2,
        			'email'=>"him@life.com",
        			'password'=>'12345678890',
        			'user_type_id'=>'2',
        			'fname'=>'Gqira',
        			'lname'=>'Kabane',
        			'sex'=>'male',
        			'contact_no'=>'9876543210',
        			'created_at'=>'2017-07-17 00:00:00',
        			'updated_at'=>'2017-07-17 00:00:00']);
    }
}
