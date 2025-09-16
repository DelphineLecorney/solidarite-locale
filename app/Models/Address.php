<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant des adresses associées à un utilisateur.
 *
 * Contient les informations géographiques et postales liées à un utilisateur,
 * telles que la rue, la ville, le code postal, la latitude et la longitude.
 *
 * @property int $user_id L'identifiant de l'utilisateur lié à cette adresse.
 * @property string $street La rue de l'adresse.
 * @property string $city La ville de l'adresse.
 * @property string $postcode Le code postal.
 * @property float|null $lat La latitude (optionnelle).
 * @property float|null $lng La longitude (optionnelle).
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user() Relation vers l'utilisateur propriétaire de l'adresse.
 */

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street',
        'city',
        'postcode',
        'lat',
        'lng',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
