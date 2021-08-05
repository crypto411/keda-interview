<?php

namespace Database\Seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert(array (
            0 => 
            array (
                'user_type_id' => 1,
                'email'      => 'customer@gmail.com',
                'password'   => '$2y$12$7zw.h44/b1dE2b1pQbze/OAo.AUJaNuz9b7ENPcpnWmtifIL3rD3C',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'user_type_id' => 2,
                'email'      => 'staff@gmail.com',
                'password'   => '$2y$12$7zw.h44/b1dE2b1pQbze/OAo.AUJaNuz9b7ENPcpnWmtifIL3rD3C',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
        ));
    }
}
