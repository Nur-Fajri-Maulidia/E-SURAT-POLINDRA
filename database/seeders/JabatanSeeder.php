<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = [
        //     'Ketua Jurusan Teknik Informatika',
        //     'Ketua Jurusan Teknik Mesin',
        //     'Ketua Jurusan Teknik Pendingin dan Tata Udara',
        //     'Kepala UPT Perpustakaan',
        //     'Kepala UPT Teknologi Informasi dan Komunikasi',
        // ];
        $data = [
            'Dosen Lektor',
            'Dosen Asisten Ahli',
            'Dosen',
            'Pengelola Situs/WEB',
            'Pengadministrasi Umum',
            'Pranata Komputer Terampil',
            'Teknisi Laboratorium',
            'Pengelola P3MP',
            'Pengolah Data Pengembangan Pembelajaran dan Penjaminan Mutu Pendidikan',
            'Pustakawan Terampil',
            'Pustakawan Ahli Pertama',
            'Pustakawan Terampil',
            'Pengelola Barang Milik Negara',
            'Pengolah Data',
            'Analis Sumber Daya Manusia Aparatur',
            'Analis Sumber Daya Manusia Aparatur Ahli Pertama',
            'Pranata Hubungan Masyarakat Ahli Pertama',
            'Arsiparis Ahli Pertama',
            'Arsiparis Terampil',
            'Pengadministrasi Gudang',
            'Penata Arsip',
            'Pengelola Informasi Akademik',
            'Arsiparis Ahli Pertama',
            'Pranata Komputer Ahli Pertama',
            'Analis Pengelolaan Keuangan APBN Ahli Muda',
            'Bendahara',
            'Pengadministrasi Umum',
            'Penyusun Laporan Keuangan',
            'Perencana Ahli Pertama',
            'Pengolah Data Akademik',
            'Satuan Pengamanan',
            'Pengadministrasi Sarana Pendidikan',
            'Teknisi Laboratorium',
            'Pranata Laboratorium Pendidikan Terampil',
            'Pranata Laboratorium Pendidikan Ahli Pertama',
            'Arsiparis Ahli Pertama',
            'Pengadministrasi Umum',
            'Teknisi Laboratorium',
            'Arsiparis Terampil',
            'Pengadministrasi Sarana Pendidikan',
            'Pranata Komputer Terampil',
            'Pengolah Data Penelitian dan Pengabdian kepada Masyarakat',
        ];
        $no = 1;
        foreach ($data as $jabatan) {
            Jabatan::create([
                'nama' => $jabatan,
            ]);
        }
    }
}
