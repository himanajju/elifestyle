<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsergroupsTableSeeder::class);
        // $this->call(ApkPermissionsTableSeeder::class);
        $this->call(PlansTableSeeder::class);
    }
}
