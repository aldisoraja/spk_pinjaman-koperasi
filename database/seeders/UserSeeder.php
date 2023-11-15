<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Pengawas Koperasi',
                'username' => 'pengawas',
                'role_id' => 1,
                'password' => Hash::make('pengawas')
            ],
            [
                'name' => 'Pengurus Koperasi',
                'username' => 'pengurus',
                'role_id' => 2,
                'password' => Hash::make('pengurus')
            ],
            
        ];

        DB::table('users')->insert($users);
    }
}
