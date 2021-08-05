<?php

namespace Database\Seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->delete();
        
        DB::table('user_types')->insert(array (
            0 => 
            array (
                'name' => 'Customer',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'name' => 'Staff',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
        ));
    }
}
