<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::create([
            'street' => 'Rue du Marché 5',
            'city' => 'Bruxelles',
            'postcode' => '1000'
        ]);

        Address::create([
            'street' => 'Avenue Louise 100',
            'city' => 'Bruxelles',
            'postcode' => '1050'
        ]);
    }
}
