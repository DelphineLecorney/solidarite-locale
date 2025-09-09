<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HelpRequest;
use App\Models\User;
use App\Models\HelpCategory;
use App\Models\Address;

class HelpRequestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $category = HelpCategory::first();

        $addr = Address::create([
            'street' => 'Avenue Albert 1er',
            'city' => 'Liège',
            'postcode' => '4000',
        ]);

        HelpRequest::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'address_id' => $addr->id,
            'title' => 'Besoin d’aide pour faire les courses',
            'description' => 'Je cherche un bénévole pour m’aider samedi matin.',
            'status' => 'pending'
        ]);
    }
}
