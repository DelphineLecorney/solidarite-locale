<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Composant Vue : Carte de tableau de bord
 *
 * Ce composant représente une carte d'information dans le tableau de bord.
 * Il permet d'afficher un titre, une valeur numérique, une icône stylisée,
 * ainsi qu'un bouton optionnel avec texte et lien.
 *
 * @package App\View\Components
 */
class DashboardCard extends Component
{
    /**
     * @var string Titre affiché sur la carte
     */
    public $title;

    /**
     * @var int Valeur numérique ou statistique à afficher
     */
    public $count;

    /**
     * @var string Classe CSS de l'icône Bootstrap
     */
    public $icon;

    /**
     * @var string Classes CSS pour le fond et la couleur de l'icône
     */
    public $iconBgClass;

    /**
     * @var string Texte du bouton (optionnel)
     */
    public $buttonText;

    /**
     * @var string URL vers laquelle le bouton redirige
     */
    public $buttonUrl;

    /**
     * @var string Classe CSS du bouton
     */
    public $buttonClass;

    /**
     * Crée une nouvelle instance du composant DashboardCard.
     *
     * @param string $title Titre de la carte
     * @param int $count Valeur à afficher (par défaut : 0)
     * @param string $icon Icône Bootstrap (par défaut : bi-info-circle)
     * @param string $iconBgClass Classes CSS pour le fond de l'icône
     * @param string $buttonText Texte du bouton (optionnel)
     * @param string $buttonUrl URL du bouton (par défaut : #)
     * @param string $buttonClass Classe CSS du bouton (par défaut : btn-info)
     */
    public function __construct(
        $title,
        $count = 0,
        $icon = 'bi-info-circle',
        $iconBgClass = 'bg-info bg-opacity-10 text-info',
        $buttonText = '',
        $buttonUrl = '#',
        $buttonClass = 'btn-info'
    ) {
        $this->title = $title;
        $this->count = $count;
        $this->icon = $icon;
        $this->iconBgClass = $iconBgClass;
        $this->buttonText = $buttonText;
        $this->buttonUrl = $buttonUrl;
        $this->buttonClass = $buttonClass;
    }

    /**
     * Retourne la vue associée au composant.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.dashboard-card');
    }
}
