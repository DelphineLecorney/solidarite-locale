<?php

namespace App\Policies;

use App\Models\HelpRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HelpRequestPolicy
{
    /**
     * Détermine si l'utilisateur peut voir la liste des demandes d'aide.
     *
     * @param User $user L'utilisateur authentifié.
     * @return bool
     */

    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut voir une demande d'aide spécifique.
     *
     * @param User $user L'utilisateur authentifié.
     * @param HelpRequest $helpRequest La demande d'aide ciblée.
     * @return bool
     */

    public function view(User $user, HelpRequest $helpRequest): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut créer une nouvelle demande d'aide.
     *
     * @param User $user L'utilisateur authentifié.
     * @return bool
     */

    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut modifier une demande d'aide.
     *
     * Seul le créateur de la demande peut la modifier.
     *
     * @param User $user L'utilisateur authentifié.
     * @param HelpRequest $helpRequest La demande d'aide ciblée.
     * @return bool
     */

    public function update(User $user, HelpRequest $helpRequest)
    {
        return $user->id === $helpRequest->user_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer une demande d'aide.
     *
     * @param User $user L'utilisateur authentifié.
     * @param HelpRequest $helpRequest La demande d'aide ciblée.
     * @return bool
     */

    public function delete(User $user, HelpRequest $helpRequest): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut restaurer une demande d'aide supprimée.
     *
     * @param User $user L'utilisateur authentifié.
     * @param HelpRequest $helpRequest La demande d'aide ciblée.
     * @return bool
     */

    public function restore(User $user, HelpRequest $helpRequest): bool
    {
        return false;
    }

    /**
     * Détermine si l'utilisateur peut supprimer définitivement une demande d'aide.
     *
     * @param User $user L'utilisateur authentifié.
     * @param HelpRequest $helpRequest La demande d'aide ciblée.
     * @return bool
     */

    public function forceDelete(User $user, HelpRequest $helpRequest): bool
    {
        return false;
    }
}
