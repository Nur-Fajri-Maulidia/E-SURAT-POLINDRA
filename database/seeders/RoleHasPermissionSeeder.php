<?php

namespace Database\Seeders;

use App\Models\RoleHasPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['1','2','3','14','15','16','17','18','19','20','21','22','23'];
        foreach($data as $permission)
        {
            RoleHasPermission::create([
                'permission_id' => $permission,
                'role_id' => 4
            ]);
        }
    }
}
