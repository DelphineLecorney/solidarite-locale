<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class OrganizationSeeder extends Seeder
{

    public function run(): void
    {
        $owner = \App\Models\User::first();
        if (!$owner) {
            $this->command->warn('Aucun utilisateur trouvé, Organisation non créée.');
            return;
        }

        $addr = \App\Models\Address::first();
        if (!$addr) {
            $this->command->warn('Aucune adresse trouvée, Organisation non créée.');
            return;
        }

        \App\Models\Organization::create([
            'name' => 'Association Bien-Être',
            'type' => 'association',
            'registration_number' => 'BE0123456789',
            'address_id' => $addr->id,
            'owner_id' => $owner->id,
        ]);
    }
};
