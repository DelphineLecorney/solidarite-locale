<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory pour générer des instances fictives du modèle User.
 *
 * Utilisée pour les tests et le seeding, cette factory crée des utilisateurs
 * avec des données réalistes : nom, email, mot de passe, etc.
 *
 * @method array definition() Définit les attributs simulés.
 * @method static unverified() Crée un utilisateur avec email non vérifié.
 */

class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Définit les valeurs fictives par défaut pour le modèle User.
     *
     * Génère un nom, une adresse email unique, une date de vérification,
     * un mot de passe hashé et un token de session.
     *
     * @return array<string, mixed> Un tableau d'attributs simulés pour un utilisateur.
     */

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indique que l'adresse email de l'utilisateur doit être non vérifiée.
     *
     * Modifie l'état du modèle pour que 'email_verified_at' soit null.
     *
     * @return static
     */

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
