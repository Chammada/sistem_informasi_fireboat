<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubJenisBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_jenis_berkas = [
            [
                'nama' => "Invoice",
                'jenis_surat' => 1,
            ],
            [
                'nama' => "Faktur Pajak",
                'jenis_surat' => 1,
            ],
            [
                'nama' => "Surat Perintah Kerja",
                'jenis_surat' => 1,
            ],
            [
                'nama' => "Rekening Koran Bank",
                'jenis_surat' => 1,
            ],
            [
                'nama' => "Surat PO",
                'jenis_surat' => 1,
            ],
            [
                'nama' => "Invoice",
                'jenis_surat' => 2,
            ],
            [
                'nama' => "Surat Jalan",
                'jenis_surat' => 2,
            ],
            [
                'nama' => "Surat Pernyataan",
                'jenis_surat' => 2,
            ],
            [
                'nama' => "Surat Permohonan",
                'jenis_surat' => 2,
            ],
            [
                'nama' => "Surat PO",
                'jenis_surat' => 2,
            ],
            [
                'nama' => 'SMA',
                'jenis_surat' => 3,
            ],
            [
                'nama' => 'SMK',
                'jenis_surat' => 3,
            ],
            [
                'nama' => 'Mahasiswa',
                'jenis_surat' => 3,
            ],
            [
                'nama' => 'Berkas Pajak Import',
                'jenis_surat' => 4,
            ],
            [
                'nama' => 'SPT Tahunan',
                'jenis_surat' => 4,
            ],
            [
                'nama' => 'SPT PPN',
                'jenis_surat' => 4,
            ],
            [
                'nama' => 'PPH 21',
                'jenis_surat' => 4,
            ],
            [
                'nama' => 'PPH 23 Bukti Potong',
                'jenis_surat' => 4,
            ],
            [
                'nama' => 'Surat Dukungan',
                'jenis_surat' => 5,
            ],
            [
                'nama' => 'Surat Pernyataan',
                'jenis_surat' => 5,
            ],
            [
                'nama' => 'Surat Fiskal',
                'jenis_surat' => 5,
            ],
            [
                'nama' => 'Pengalaman Proyek',
                'jenis_surat' => 5,
            ],
            [
                'nama' => 'Data Perusahaan',
                'jenis_surat' => 5,
            ],

        ];

        DB::table('sub_jenis_berkas')->insert($sub_jenis_berkas);
    }
}
