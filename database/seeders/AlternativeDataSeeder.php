<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternatif = [
            [
                'no_anggota' => 'A-01',
                'nama_anggota' => 'Dewi Kumala',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-05-28',
                // 'pekerjaan' => 'Pegawai Negeri Sipil',
                // 'penghasilan' => 5000000,
                'besar_pinjaman' => 15000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-02',
                'nama_anggota' => 'Siti Mudji',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-05-29',
                // 'pekerjaan' => 'Pedagang',
                // 'penghasilan' => 3000000,
                'besar_pinjaman' => 10000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-03',
                'nama_anggota' => 'Saputro Adji',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-05-30',
                // 'pekerjaan' => 'Wirausaha',
                // 'penghasilan' => 6000000,
                'besar_pinjaman' => 25000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-04',
                'nama_anggota' => 'Dwiaryani',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-05-31',
                // 'pekerjaan' => 'Pedagang',
                // 'penghasilan' => 3500000,
                'besar_pinjaman' => 10000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-05',
                'nama_anggota' => 'Mansyur Suryo',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-06-01',
                // 'pekerjaan' => 'Pedagang',
                // 'penghasilan' => 4000000,
                'besar_pinjaman' => 10000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-06',
                'nama_anggota' => 'Laksmi Asih',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-06-02',
                // 'pekerjaan' => 'Wirausaha',
                // 'penghasilan' => 5000000,
                'besar_pinjaman' => 10000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'no_anggota' => 'A-07',
                'nama_anggota' => 'Bambang Saputro',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2023-06-03',
                // 'pekerjaan' => 'Karyawan Swasta',
                // 'penghasilan' => 4500000,
                'besar_pinjaman' => 15000000,
                'alamat' => 'Surabaya',
                'keperluan' => 'Rumah tangga',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            
         
        ];

        DB::table('alternatif')->insert($alternatif);
    }
}
