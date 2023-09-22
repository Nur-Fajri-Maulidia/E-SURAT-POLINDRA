<?php

namespace Database\Seeders;

use App\Models\RoleHasPermission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            InstansiSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UnitKerjaSeeder::class,
            JabatanSeeder::class,
            PangkatSeeder::class,
            Pengguna::class,
        ]);
    }
}
