<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instansi::create([
            'nama' => 'Politeknik Negeri Indramayu',
            'akun' => '2209283'
        ]);
    }
}
