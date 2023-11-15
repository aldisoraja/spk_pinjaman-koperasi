<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Pekerjaan',
                'faktor_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Penghasilan',
                'faktor_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Besar Pinjaman',
                'faktor_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Lama Pinjaman',
                'faktor_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Jaminan',
                'faktor_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_kriteria' => 'Simpanan',
                'faktor_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
        DB::table('kriteria')->insert($kriteria);
    }
}
