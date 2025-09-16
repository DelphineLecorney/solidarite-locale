<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une demande d'aide créée par un utilisateur.
 *
 * Une demande peut être liée à une catégorie, une adresse, et contenir des participations
 * de bénévoles. Elle peut aussi être acceptée par un autre utilisateur.
 *
 * @property int $user_id L'identifiant de l'utilisateur ayant créé la demande.
 * @property int $category_id L'identifiant de la catégorie de besoin.
 * @property int $address_id L'identifiant de l'adresse associée.
 * @property string $title Le titre de la demande.
 * @property string $description La description détaillée du besoin.
 * @property string $status Le statut de la demande (ex. : 'ouverte', 'acceptée', 'terminée').
 * @property \Carbon\Carbon|null $scheduled_at La date prévue pour l'intervention.
 * @property int|null $accepted_by_user_id L'identifiant du bénévole ayant accepté la demande.
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user() L'utilisateur créateur de la demande.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo category() La catégorie associée.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo address() L'adresse liée à la demande.
 * @method \Illuminate\Database\Eloquent\Relations\HasMany participations() Les participations des bénévoles.
 */

class HelpRequest extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'address_id',
        'user_id',
        'status',
        'scheduled_at',
        'accepted_by_user_id',
    ];

    /**
     * Relation vers l'utilisateur ayant créé la demande d'aide.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation vers la catégorie de besoin associée à cette demande.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(HelpCategory::class, 'category_id');
    }

    /**
     * Relation vers l'adresse liée à cette demande d'aide.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relation vers les participations des bénévoles à cette demande.
     *
     * le modèle Participation référence le bénévole
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participations()
    {
        return $this->hasMany(Participation::class, 'volunteer_id');
    }
}
