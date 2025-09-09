<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer des adresses
        $addresses = Address::factory()->count(2)->create();

        // 2. Créer des utilisateurs en assignant une adresse
        User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'password' => bcrypt('secret123'),
            'phone' => '0470123456',
            'address_id' => $addresses->first()->id
        ]);

        User::create([
            'name' => 'Marie Curie',
            'email' => 'marie@example.com',
            'password' => bcrypt('secret'),
            'phone' => '0489001122',
            'address_id' => $addresses->last()->id
        ]);
    }
}
