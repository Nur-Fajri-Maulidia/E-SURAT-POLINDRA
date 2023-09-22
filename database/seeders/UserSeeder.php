<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // role
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
        $admin->assignRole('Admin');

        $u1 = User::create([
            'name' => 'Eka Ismantohadi, S.Kom., M.Eng.',
            'username' => 'eka123',
            'email' => 'eka@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '198107092021211005',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'unit_kerja_id' => 1,
            'tte_pin' => bcrypt('12345'),
        ]);
        $u1->assignRole('K-Unit');

        $u2 = User::create([
            'name' => 'Badruzzaman, S.ST., M.T.',
            'username' => 'badru123',
            'email' => 'badru@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '198409162019031004',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 2,
            'unit_kerja_id' => 2,
            'tte_pin' => bcrypt('12345'),

        ]);
        $u2->assignRole('K-Unit');

        $u3 = User::create([
            'name' => 'Aa Setiawan, S.T., M.T.',
            'username' => 'setia123',
            'email' => 'setia@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '197901012021211013',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 3,
            'unit_kerja_id' => 3,
            'tte_pin' => bcrypt('12345'),

        ]);
        $u3->assignRole('K-Unit');

        $u4 = User::create([
            'name' => 'Wardika, S.ST., M.Eng.',
            'username' => 'wardika123',
            'email' => 'wardika@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '198511172019031011',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 4,
            'unit_kerja_id' => 4,
            'tte_pin' => bcrypt('12345'),

        ]);
        $u4->assignRole('K-Unit');

        $u5 = User::create([
            'name' => 'Adi Suheryadi, S.ST., M.Kom.',
            'username' => 'adi123',
            'email' => 'adi@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '199003222019031007',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 5,
            'unit_kerja_id' => 5,
            'tte_pin' => bcrypt('12345'),

        ]);
        $u5->assignRole('K-Unit');

        // direktur
        $direktur = User::create([
            'name' => 'Rofan Aziz, S.T., M.T.',
            'username' => 'rofan123',
            'email' => 'rofan@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '198506212020121004',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 6,
            'tte_pin' => bcrypt('12345'),
        ]);

        $direktur->assignRole('Direktur');

        // wakil_direktur
        $wakil_direktur = User::create([
            'name' => 'Karsid, S.T., M.T., M.Sc.',
            'email' => 'karsid@gmail.com',
            'password' => bcrypt('12345'),
            'nip' => '198307182021211001',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 7,
            'tte_pin' => bcrypt('12345'),
        ]);
        $wakil_direktur->assignRole('Wakil Direktur');

        // k_unit
        $k_unit = User::create([
            'name' => 'K Unit',
            'email' => 'kunit@gmail.com',
            'password' => bcrypt('password')
        ]);
        $k_unit->assignRole('K-Unit');

        // karyawan
        $karyawan = User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => bcrypt('password')
        ]);
        $karyawan->assignRole('Karyawan');
    }
}
