```
/projet3
│
├── .env                      ← Fichier de configuration d'environnement
├── .env.php                  ← Chargeur de variables d'environnement
├── .htaccess                 ← Redirection vers /public/index.php
├── routes.php                ← Déclaration des routes
├── Routeur.php               ← Classe de routage principale
├── projet3.md                ← Documentation du projet
│
├── config/                   ← Fichiers de configuration
│   ├── bd.php                ← Paramètres de connexion à la base de données
│   └── Database.php          ← Classe d’abstraction PDO
│
├── controllers/             ← Contrôleurs MVC
│   ├── AccueilController.php
│   ├── AnnonceController.php
│   ├── CategorieController.php
│   ├── ErreurController.php
│   ├── FavorisController.php
│   ├── ProfilController.php
│   └── UtilisateurController.php
│
├── models/                  ← Modèles métiers
│   ├── Annonce.php
│   ├── Categorie.php
│   └── Utilisateur.php
│
├── utils/                   ← Fonctions utilitaires réutilisables
│   ├── index.php
│   ├── Session.php
│   └── Validation.php
│
├── views/                   ← Vues HTML
│   ├── accueil.view.php
│   ├── erreur.view.php
│   ├── partials/            ← Entête, pied de page, etc.
│   ├── annonces/            ← Pages liées aux annonces
│   ├── favoris/             ← Pages de favoris
│   └── utilisateur/         ← Pages de connexion, inscription, profil, etc.
│
└── public/                  ← Point d’entrée du site (accessible publiquement)
    ├── index.php            ← Lance l’application (inclut le routeur)
    ├── css/                 ← Fichiers de styles CSS
    └── images/              ← Images du site
```