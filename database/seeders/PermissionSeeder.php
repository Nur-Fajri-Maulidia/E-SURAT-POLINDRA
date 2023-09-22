<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Dashboard',
            'Profile Edit',
            'Password Edit',
            'Category Index',
            'Category Create',
            'Category Update',
            'Category Delete',
            'Category Detail Index',
            'Category Detail Create',
            'Category Detail Update',
            'Category Detail Delete',
            'Notifikasi Index',
            'Notifikasi Create',
            'Notifikasi Update',
            'Notifikasi Delete',
            'Notifikasi Show',
            'Surat Umum Create',
            'Surat Masuk Index',
            'Surat Masuk Show',
            'Surat Masuk TTE',
            'Surat Keluar Index',
            'Surat Keluar Show',
            'Surat Keluar Update',
            'Surat Keluar Delete',
            'Surat Keluar TTE',
            'Unit Kerja Index',
            'Unit Kerja Create',
            'Unit Kerja Update',
            'Unit Kerja Delete',
            'Unit Kerja Role Add',
            'Jabatan Index',
            'Jabatan Create',
            'Jabatan Update',
            'Jabatan Delete',
            'Pangkat Index',
            'Pangkat Create',
            'Pangkat Update',
            'Pangkat Delete',
            'Role Index',
            'Role Create',
            'Role Update',
            'Role Delete',
            'Role Permission',
            'Permission Index',
            'Permission Create',
            'Permission Update',
            'Permission Delete',
            'User Index',
            'User Create',
            'User Update',
            'User Delete',
            'Document Disposisi'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
