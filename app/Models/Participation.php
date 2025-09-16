<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Modèle représentant la participation d'un bénévole à une mission ou une demande d'aide.
 *
 * Chaque participation est liée à un utilisateur (volontaire) et à une mission ou demande.
 *
 * @property int $volunteer_id L'identifiant du bénévole.
 * @property int $mission_id L'identifiant de la mission concernée.
 * @property int|null $help_request_id L'identifiant de la demande d'aide.
 * @property string $status Le statut de la participation (ex. : 'confirmée', 'annulée').
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo volunteer() Le bénévole participant.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo mission() La mission concernée.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo helpRequest() La demande d'aide concernée.
 */
class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'volunteer_id',
        'status',
        'hours_logged',
        'quantity_received',
    ];

    /**
     * Relation vers la mission concernée par la participation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * Relation vers le bénévole qui participe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}
