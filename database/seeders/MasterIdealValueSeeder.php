<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterIdealValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ideal = [
            [
                'kriteria_id' => 1,
                'nilai_ideal' => 3,
            ],
            [
                'kriteria_id' => 2,
                'nilai_ideal' => 4,
            ],
            [
                'kriteria_id' => 3,
                'nilai_ideal' => 4,
            ],
            [
                'kriteria_id' => 4,
                'nilai_ideal' => 3,
            ],
            [
                'kriteria_id' => 5,
                'nilai_ideal' => 4,
            ],
            [
                'kriteria_id' => 6,
                'nilai_ideal' => 3,
            ],
        ];

        DB::table('kriteria_ideal')->insert($ideal);
    }
}
