<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterGapValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gap = [
            [
                'bobot_nilai_kriteria' => 5,
                'nilai_gap' => 0,
                'keterangan' => 'Tidak ada GAP (kompetensi sesuai yang dibutuhkan)',
            ],
            [
                'bobot_nilai_kriteria' => 4.5,
                'nilai_gap' => 1,
                'keterangan' => 'Kompetensi individu kelebihan 1 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 4,
                'nilai_gap' => -1,
                'keterangan' => 'Kompetensi individu kurang 1 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 3.5,
                'nilai_gap' => 2,
                'keterangan' => 'Kompetensi individu kelebihan 2 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 3,
                'nilai_gap' => -2,
                'keterangan' => 'Kompetensi individu kurang 2 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 2.5,
                'nilai_gap' => 3,
                'keterangan' => 'Kompetensi individu kelebihan 3 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 2,
                'nilai_gap' => -3,
                'keterangan' => 'Kompetensi individu kurang 3 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 1.5,
                'nilai_gap' => 4,
                'keterangan' => 'Kompetensi individu kelebihan 4 tingkat/level',
            ],
            [
                'bobot_nilai_kriteria' => 1,
                'nilai_gap' => -4,
                'keterangan' => 'Kompetensi individu kurang 4 tingkat/level',
            ],
        ];

        DB::table('bobot_nilai_gap')->insert($gap);
    }
}
