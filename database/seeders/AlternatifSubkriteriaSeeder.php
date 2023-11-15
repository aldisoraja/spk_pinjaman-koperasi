<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSubkriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternatifSub = [
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 38,
                ],
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 84,
                ],
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 87,
                ],
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 92,
                ],
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 97,
                ],
                [
                  'alternatif_id' => 1,
                  'subkriteria_id' => 102,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 37,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 82,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 86,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 91,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 96,
                ],
                [
                  'alternatif_id' => 2,
                  'subkriteria_id' => 100,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 56,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 84,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 88,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 90,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 99,
                ],
                [
                  'alternatif_id' => 3,
                  'subkriteria_id' => 101,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 37,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 83,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 86,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 91,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 96,
                ],
                [
                  'alternatif_id' => 4,
                  'subkriteria_id' => 100,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 37,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 83,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 86,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 92,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 98,
                ],
                [
                  'alternatif_id' => 5,
                  'subkriteria_id' => 100,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 56,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 84,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 86,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 92,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 98,
                ],
                [
                  'alternatif_id' => 6,
                  'subkriteria_id' => 100,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 24,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 83,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 87,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 90,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 98,
                ],
                [
                  'alternatif_id' => 7,
                  'subkriteria_id' => 100,
                ],

        ];
        DB::table('alternatif_subkriteria')->insert($alternatifSub);
    }
}
