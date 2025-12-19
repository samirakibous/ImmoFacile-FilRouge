# ImmoFacile

## 📋 Description

**ImmoFacile** est une plateforme web immobilière complète développée avec **Laravel 11**, permettant la gestion d'annonces immobilières avec un système multi-rôles sophistiqué. La plateforme offre une expérience utilisateur moderne avec recherche avancée, paiement en ligne sécurisé via Stripe, et génération automatique de factures PDF.

## ✨ Fonctionnalités Principales

### 🔐 Gestion des Utilisateurs & Authentification
- **Système multi-rôles** (Admin, Agent, Client) via middleware personnalisé
- **Authentification OAuth** Google (Laravel Socialite)
- **Gestion complète du profil** : modification, activation/désactivation compte
- **Validation des demandes agents** par l'administrateur
- **Système de notifications** email

### 🏠 Gestion des Annonces Immobilières
- **CRUD complet** des propriétés (Create, Read, Update, Delete)
- **Upload multiple d'images** avec sélection de photo de couverture
- **Filtrage avancé** : type (vente/location), catégorie, ville, prix, surface
- **Caractéristiques détaillées** : chambres, salles de bain, équipements (ascenseur, parking, piscine)
- **Statuts de disponibilité** : disponible, vendu, non disponible
- **Système de favoris** pour les utilisateurs

### 💳 Paiement & Facturation
- **Intégration Stripe** pour paiements sécurisés
- **Génération automatique de factures PDF** avec DomPDF
- **Historique des achats** avec détails des transactions
- **Factures téléchargeables** avec numéro unique
- **Page de confirmation** après paiement réussi

### 📊 Tableau de Bord Administrateur
- **Statistiques en temps réel** : utilisateurs actifs/suspendus, annonces par statut
- **Gestion des utilisateurs** : CRUD, changement de rôle/statut
- **Gestion des annonces** : validation, suppression, modération
- **Gestion des catégories** et équipements
- **Validation des demandes d'agents**

### 👨‍💼 Profils Agents
- **Profils publics détaillés** avec portfolio d'annonces
- **Liste d'agents vérifiés** avec filtres
- **Système d'avis et notations** par les clients
- **Gestion personnelle des annonces** par agent
- **Informations de contact** : téléphone, email, réseaux sociaux

### 🔍 Recherche & Navigation
- **Barre de recherche avancée** avec filtres multiples
- **Pages dédiées** : Vendre, Louer, Agents
- **Composants réutilisables** pour affichage uniforme
- **Interface responsive** et intuitive

## 🛠️ Technologies Utilisées

### Backend
- **PHP 8.2+**
- **Laravel 11** - Framework MVC
- **Laravel Sanctum** - Authentification API
- **Laravel Socialite** - OAuth (Google)
- **DomPDF** - Génération de documents PDF
- **Stripe PHP SDK** - Paiements en ligne

### Frontend
- **Blade Templates** - Moteur de templates Laravel
- **Tailwind CSS** - Framework CSS utilitaire
- **Vite** - Build tool moderne
- **Font Awesome 6.4.0** - Bibliothèque d'icônes
- **Chart.js** - Graphiques interactifs
- **Google Fonts** - Poppins, Poly

### Base de Données
- **MySQL/MariaDB** (recommandé)
- Support multi-SGBD : PostgreSQL, SQLite, SQL Server

### Outils de Développement
- **Composer** - Gestionnaire de dépendances PHP
- **NPM** - Gestionnaire de paquets JavaScript
- **Concurrently** - Exécution simultanée de tâches
- **EditorConfig** - Configuration standardisée

## 📦 Installation

### Prérequis
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Serveur web (Apache/Nginx) ou Laragon

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/samirakibous/ImmoFacile-FilRouge.git
cd ImmoFacile-FilRouge
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
Modifier le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=immofacile
DB_USERNAME=root
DB_PASSWORD=
```

6. **Configurer Stripe**
Ajouter vos clés Stripe dans `.env` :
```env
STRIPE_KEY=votre_cle_publique
STRIPE_SECRET=votre_cle_secrete
```

7. **Configurer Google OAuth**
```env
GOOGLE_CLIENT_ID=votre_client_id
GOOGLE_CLIENT_SECRET=votre_client_secret
GOOGLE_REDIRECT_URL=http://localhost/auth/google/callback
```

8. **Exécuter les migrations**
```bash
php artisan migrate
```

9. **Créer le lien symbolique pour le stockage**
```bash
php artisan storage:link
```

10. **Compiler les assets**
```bash
npm run dev
# ou pour la production
npm run build
```

11. **Lancer le serveur**
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 🚀 Utilisation

### Créer un compte administrateur
```bash
php artisan tinker
```
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@immofacile.com';
$user->password = bcrypt('password');
$user->role_id = 1; // ID du rôle admin
$user->save();
```

### Routes principales
- **Accueil** : `/`
- **Connexion** : `/login`
- **Inscription** : `/signup`
- **Dashboard Admin** : `/admin/dashboard`
- **Profil Agent** : `/agent/profile`
- **Ajouter une annonce** : `/agent/AddAnnonce`
- **Liste des agents** : `/agents`

## 📁 Structure du Projet

```
ImmoFacile/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Contrôleurs
│   │   └── Middleware/      # Middleware personnalisés
│   ├── Models/              # Modèles Eloquent
│   ├── Notifications/       # Notifications email
│   └── Services/            # Logique métier
├── database/
│   └── migrations/          # Migrations de base de données
├── resources/
│   ├── views/
│   │   ├── components/      # Composants Blade réutilisables
│   │   ├── admin/           # Vues administrateur
│   │   └── layouts/         # Layouts principaux
│   ├── css/                 # Fichiers CSS/Tailwind
│   └── js/                  # Fichiers JavaScript
├── routes/
│   └── web.php              # Routes web
└── public/                  # Assets publics
```

## 🔒 Sécurité

- **Validation des données** côté serveur dans tous les controllers
- **Protection CSRF** activée sur tous les formulaires
- **Middleware d'authentification** et d'autorisation
- **Paiements sécurisés** via Stripe
- **Hashage des mots de passe** avec bcrypt

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Auteurs

- **SAMIRA KIBOUS** - *Travail initial* - [samirakibous](https://github.com/samirakibous)

## 📧 Contact

Pour toute question ou suggestion :
- Email : contact@immofacile.fr
- GitHub : [https://github.com/samirakibous/ImmoFacile-FilRouge](https://github.com/samirakibous/ImmoFacile-FilRouge)

## 🙏 Remerciements

- Laravel Framework
- Tailwind CSS
- Stripe
- DomPDF
- Font Awesome
- Tous les contributeurs open source

---

**ImmoFacile** - Votre partenaire immobilier de confiance 🏠