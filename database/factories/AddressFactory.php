<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
        ];
    }
}
