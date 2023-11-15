<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'Pengawas Koperasi'
            ],
            [
                'role_name' => 'Pengurus Koperasi'
            ],
        ];

        DB::table('role')->insert($roles);
    }
}
