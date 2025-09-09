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
        $users = User::all();
        $categories = HelpCategory::all();
        $addresses = Address::all();

        if ($users->isEmpty() || $categories->isEmpty() || $addresses->isEmpty()) {
            $this->command->warn('Impossible de créer des demandes : utilisateurs, catégories ou adresses manquants.');
            return;
        }

        // Créons 10 demandes aléatoires
        for ($i = 1; $i <= 10; $i++) {
            HelpRequest::create([
                'title' => "Demande d'aide #$i",
                'description' => "Description de la demande d'aide numéro $i.",
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'address_id' => $addresses->random()->id,
                'status' => 'pending',
            ]);
        }
    }
}
