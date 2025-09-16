<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * Modèle représentant une organisation ou une commune.
 *
 * Une organisation peut publier plusieurs missions, possède une adresse,
 * et est administrée par un utilisateur propriétaire.
 *
 * @property string $name Le nom de l'organisation.
 * @property string $type Le type d'organisation (ex. : association, commune).
 * @property string $registration_number Le numéro d'enregistrement officiel.
 * @property int $address_id L'identifiant de l'adresse associée.
 * @property int $owner_id L'identifiant de l'utilisateur propriétaire.
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo address() L'adresse de l'organisation.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo owner() L'utilisateur propriétaire.
 * @method \Illuminate\Database\Eloquent\Relations\HasMany missions() Les missions publiées par l'organisation.
 */

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'registration_number',
        'address_id',
        'owner_id'
    ];


    /**
     * Relation vers l'adresse associée à cette organisation.
     *
     * Permet d'accéder aux coordonnées géographiques de l'organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relation vers l'utilisateur propriétaire de l'organisation.
     *
     * Généralement un administrateur ou responsable de la structure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Relation vers les missions publiées par cette organisation.
     *
     * Permet d'accéder à toutes les actions proposées par la structure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
