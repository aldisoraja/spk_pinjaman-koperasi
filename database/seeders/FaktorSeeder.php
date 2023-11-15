<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaktorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faktor = [
            [
                'nama_faktor' => 'Core Factor',
                'bobot_faktor' => 80,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama_faktor' => 'Secondary Factor',
                'bobot_faktor' => 20,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        DB::table('faktor')->insert($faktor);
    }
}
