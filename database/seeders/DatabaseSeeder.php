<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            HelpCategorySeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            OrganizationSeeder::class,
            HelpRequestSeeder::class,
            MissionSeeder::class,
        ]);

        $this->call(AdminUserSeeder::class);
    }
}
