<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une candidature d'un bénévole à une demande d'aide.
 *
 * Contient les informations liées à une application : le message du bénévole,
 * le statut de la candidature, et les relations avec la demande d'aide et l'utilisateur.
 *
 * @property int $help_request_id L'identifiant de la demande d'aide concernée.
 * @property int $volunteer_id L'identifiant du bénévole ayant postulé.
 * @property string $message Le message accompagnant la candidature.
 * @property string $status Le statut de la candidature (ex. : 'en attente', 'acceptée', 'refusée').
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo helpRequest() Relation vers la demande d'aide.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo volunteer() Relation vers le bénévole (utilisateur).
 */


class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'help_request_id',
        'volunteer_id',
        'message',
        'status'
    ];

    /**
     * Relation vers la demande d'aide associée à cette candidature.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    /**
     * Relation vers le bénévole (utilisateur) ayant postulé.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}
