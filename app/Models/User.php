<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Modèle représentant un utilisateur de l'application.
 *
 * Un utilisateur peut créer des demandes d'aide, participer à des missions,
 * appartenir à une organisation, et posséder une adresse.
 *
 * @property string $name Le nom complet de l'utilisateur.
 * @property string $email L'adresse email de l'utilisateur.
 * @property string|null $phone Le numéro de téléphone (optionnel).
 * @property string $password Le mot de passe hashé.
 * @property int|null $address_id L'identifiant de l'adresse associée.
 *
 * @method \Illuminate\Database\Eloquent\Relations\HasMany helpRequests() Les demandes d'aide créées par l'utilisateur.
 * @method \Illuminate\Database\Eloquent\Relations\HasMany participations() Les missions auxquelles l'utilisateur participe.
 * @method \Illuminate\Database\Eloquent\Relations\HasOne organization() L'organisation que l'utilisateur possède (si propriétaire).
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo address() L'adresse liée à l'utilisateur.
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Les attributs pouvant être attribués en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address_id',
        'role',
    ];

    /**
     * Les attributs qui doivent être masqués pour la sérialisation.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation vers les adresses associées à l'utilisateur.
     *
     * Un utilisateur peut avoir plusieurs adresses enregistrées.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Relation vers les demandes d'aide créées par l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class);
    }

    /**
     * Relation vers les candidatures envoyées par l'utilisateur en tant que bénévole.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'volunteer_id');
    }

    /**
     * Relation vers les organisations dont l'utilisateur est propriétaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedOrganizations()
    {
        return $this->hasMany(Organization::class, 'owner_id');
    }

    /**
     * Relation vers les participations de l'utilisateur à des missions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participations()
    {
        return $this->hasMany(Participation::class, 'volunteer_id');
    }
}
