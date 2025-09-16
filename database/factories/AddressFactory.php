<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

/**
 * Factory pour générer des instances fictives du modèle Address.
 *
 * Utilisée principalement pour les tests et le seeding de la base de données.
 * Génère des adresses réalistes avec rue, ville et code postal.
 *
 * @method array definition() Définit les attributs simulés pour une adresse.
 */

class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Définit les valeurs fictives pour une adresse.
     *
     * @return array<string, mixed> Un tableau contenant les champs street, city et postcode.
     */
    public function definition(): array
    {
        return [
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
        ];
    }
}
