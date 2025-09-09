<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HelpCategory;

class HelpCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Courses', 'slug' => 'courses'],
            ['name' => 'Transport', 'slug' => 'transport'],
            ['name' => 'Compagnie', 'slug' => 'compagnie'],
            ['name' => 'Soins légers', 'slug' => 'soins-legers'],
        ];

        foreach ($categories as $cat) {
            HelpCategory::create($cat);
        }
    }
}
