<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Prodi Keperawatan',
            'Jurusan Teknik Informatika',
            'Jurusan Teknik Mesin',
            'Jurusan Teknik Pendingin dan Tata Udara',
            'UPT Teknologi Informasi dan Komunikasi',
            'Pusat Pengembangan Pembelajaran dan Penjaminan Mutu Pendidikan',
            'UPT Perpustakaan',
            'Subbagian Umum',
            'Subbagian Akademik dan Kemahasiswaan',
            'Subbagian Keuangan',
            'Pusat Penelitian Pengabdian Kepada Masyarakat (P3M)',
        ];
        foreach ($data as $unit) {
            UnitKerja::create([
                'name' => $unit
            ]);
        }
    }
}
