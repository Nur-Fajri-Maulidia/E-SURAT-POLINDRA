<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Pembina / IV/a',
            'Pembina Tk 1 / IV/b',
            'Penata Tk 1 / III/d',
            'Penata Tk 1 / IV/a',
            'Pembina Utama Muda / IV/c',
            'Penata Muda Tk 1 / III/b',
            'Penata/ III/c',
            'Penata Muda Tk 1 / III/b',
            'XI',
            'X',
            'Pengatur / II/c',
            'Pengatur Tk.I/ II/d',
            'VI',
            'IX',
            'Penata Muda / III/a',
            'VII',
            'Penata / III/c',
        ];

        foreach ($data as $pangkat) {
            Pangkat::create([
                'name' => $pangkat,
            ]);
        }
    }
}
