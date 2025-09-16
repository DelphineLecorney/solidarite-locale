<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une catégorie de besoin pour les demandes d'aide.
 *
 * Chaque catégorie regroupe plusieurs demandes similaires (ex. : courses, transport, accompagnement).
 *
 * @property string $name Le nom de la catégorie.
 * @property string $slug Le slug URL-friendly de la catégorie.
 *
 * @method \Illuminate\Database\Eloquent\Relations\HasMany helpRequests() Les demandes associées à cette catégorie.
 */

class HelpCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Relation vers les demandes d'aide associées à cette catégorie.
     *
     * Permet d'accéder à toutes les demandes liées à une catégorie spécifique
     * (ex. : courses, transport, etc.).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class, 'category_id');
    }
}
