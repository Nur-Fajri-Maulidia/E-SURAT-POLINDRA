<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'code' => 'SE',
            'name' => 'Surat Edaran',
        ]);
        Category::create([
            'code' => 'SK',
            'name' => 'Surat Keterangan',
        ]);
        Category::create([
            'code' => 'SPM',
            'name' => 'Surat Pengumuman',
        ]);
        Category::create([
            'code' => 'SP',
            'name' => 'Surat Pernyataan',
        ]);
        Category::create([
            'code' => 'ST',
            'name' => 'Surat Tugas',
        ]);
        Category::create([
            'code' => 'SU',
            'name' => 'Surat Umum',
        ]);
        Category::create([
            'code' => 'SUND',
            'name' => 'Surat Undangan',
        ]);
    }
}
