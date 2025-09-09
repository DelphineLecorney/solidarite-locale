<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mission;
use App\Models\Organization;
use App\Models\Address;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        $org = Organization::first();

        $addr = Address::create([
            'street' => 'Rue des Volontaires 20',
            'city' => 'Mons',
            'postcode' => '7000',
        ]);

        Mission::create([
            'organization_id' => $org->id,
            'title' => 'Distribution de repas',
            'description' => 'Venez aider à distribuer des repas chauds aux personnes dans le besoin.',
            'address_id' => $addr->id,
            'capacity' => 10,
            'is_published' => true,
            'starts_at' => now()->addDays(2),
            'ends_at' => now()->addDays(2)->addHours(4),
        ]);
    }
}
