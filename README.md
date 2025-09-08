# Solidarité Locale 🇧🇪

**Solidarité Locale** — plateforme d'entraide locale pour communes et associations en Belgique.  
Objectif : connecter des citoyen·ne·s en besoin ponctuel d’aide avec des volontaires et associations du quartier.

---

## 🎯 Pitch
Permettre des actions solidaires de proximité : aide pour courses, déménagements, soutien scolaire, collectes, etc.  
Valorisation du bénévolat via suivi d'heures, attestations PDF et tableau de bord pour les associations/communes.

---

## 🧩 Fonctionnalités (MVP)
- Publier une demande d'aide (localisation, créneau, description, photo)
- Volontaires : profil compétences, postuler, historique, compteur d'heures
- Associations/communes : publier missions, valider participations, générer attestations PDF
- Recherche & carte (géolocalisation par quartier/commune)
- Authentification (Breeze + Livewire), rôles & permissions (Spatie)
- Journal d'activité (audit), RGPD (export / suppression)

---

## 🛠️ Stack technique
- **Backend** : Laravel 11+, PHP 8.2/8.3
- **Frontend** : Blade + Livewire, Tailwind CSS (Dark mode)
- **DB** : MySQL 8 / PostgreSQL 14
- **Paquets recommandés** : spatie/laravel-permission, spatie/laravel-medialibrary, spatie/laravel-activitylog, laravel/breeze, dompdf/snappy
- **Tests** : Pest / PHPUnit
- **Déploiement** : Docker Compose (dev), Render / Forge / Railway (prod)

---

## 🧭 Installation locale (rapide)
```bash
git clone git@github.com:TonPseudo/solidarite-locale.git
cd solidarite-locale
cp .env.example .env
composer install
npm install
php artisan key:generate
# config DB dans .env puis :
php artisan migrate --seed
npm run dev
php artisan serve
