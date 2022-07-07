<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jenis_berkas = [
            [
                'nama' => "Surat Masuk"
            ],
            [
                'nama' => "Surat Keluar"
            ],
            [
                'nama' => "Berkas Mahasiswa atau Siswa Magang"
            ],
            [
                'nama' => "Berkas Pajak Perusahaan"
            ],
            [
                'nama' => "Berkas Tender"
            ],

        ];

        DB::table('jenis_berkas')->insert($jenis_berkas);
    }
}
