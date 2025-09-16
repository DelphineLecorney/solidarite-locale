<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Modèle représentant une mission organisée par une association.
 *
 * Une mission peut être liée à une organisation, une adresse, et contenir plusieurs participations
 * de bénévoles. Elle possède des attributs comme le titre, la description, la capacité, le type,
 * et des indicateurs de publication.
 *
 * @property int $organization_id L'identifiant de l'organisation responsable.
 * @property string $title Le titre de la mission.
 * @property string $description La description détaillée de la mission.
 * @property int $address_id L'identifiant de l'adresse où se déroule la mission.
 * @property int $capacity Le nombre maximum de bénévoles attendus.
 * @property bool $is_published Indique si la mission est visible publiquement.
 * @property int $quantity_available Quantité restante disponible (si applicable).
 * @property string $unit L'unité associée à la quantité (ex. : repas, colis).
 * @property string $type Le type de mission (ex. : ponctuelle, récurrente).
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo organization() L'organisation liée à la mission.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo address() L'adresse de la mission.
 * @method \Illuminate\Database\Eloquent\Relations\HasMany participations() Les participations des bénévoles.
 */

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'address_id',
        'capacity',
        'is_published',
        'quantity_available',
        'unit',
        'type',
    ];

    /**
     * Relation vers l'organisation qui a publié cette mission.
     *
     * Permet d'accéder aux informations de l'association responsable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Relation vers l'adresse où se déroule la mission.
     *
     * Permet de localiser géographiquement la mission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relation vers les participations des bénévoles à cette mission.
     *
     * Permet d'accéder à tous les engagements liés à cette mission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participations()
    {
        return $this->hasMany(Participation::class, 'mission_id');
    }
}
