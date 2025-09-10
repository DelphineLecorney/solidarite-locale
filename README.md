# Solidarité Locale 🇧🇪

**Solidarité Locale** — plateforme d'entraide locale pour communes et associations en Belgique.  
Objectif : connecter des citoyen(ne)s en besoin ponctuel d’aide avec des volontaires et associations du quartier.

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
- **Frontend** : Blade + Bootstrap 5, Vite  
- **DB** : MySQL 8 / SQLite (dev)  
- **Paquets principaux** : laravel/breeze, spatie/laravel-permission, spatie/laravel-activitylog  
- **Tests** : Pest / PHPUnit (optionnel)  
- **Déploiement** : Docker Compose (dev), Render / Forge / Railway (prod)  


---

## 🖼️ Aperçus

### Page d’accueil
![Home Page](public\images\home.png)

### Dashboard (connecté)
![Dashboard](public\images\dashboard.png)

---

## 🧭 Installation locale

1. **Cloner le repo**  
```bash
git clone git@github.com:TonPseudo/solidarite-locale.git
cd solidarite-locale
```

2. **Copier et configurer le fichier .env**
```bash
cp .env.example .env
```

- Configurer la base de données (DB_CONNECTION, DB_DATABASE, etc.)

3. **Installer les dépendances PHP et JS**
```bash
composer install
npm install
```

4. **Générer la clé d'application Laravel**
```bash
php artisan key:generate
```

5. **Migrer la base de données et ajouter des données de test**
```bash
Migrer la base de données et ajouter des données de test
```

6. **Démarrer le serveur de développement frontend avec Vite**
```bash
npm run dev
```

7. **Démarrer le serveur Laravel**
```bash
php artisan serve
```
