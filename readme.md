# PopBazar

Plateforme de gestion de petites annonces – Projet final du cours 420-W46-GG

## Auteurs

* Zachary Bellerose
* Adam Ali

## Technologies utilisées

* **PHP 7.4+** : Traitement serveur
* **MySQL** : Base de données relationnelle
* **HTML5 / CSS3** : Structure et mise en page
* **Bootstrap 5** : Design responsive
* **JavaScript (minimal)** : Interactivité
* **WAMP / phpMyAdmin** : Environnement local de développement
* **Git / GitHub** : Suivi de version et collaboration

## Installation et exécution

1. **Installer le projet** :

   * Décompresser le dossier dans `C:/wamp64/www/popbazar`
   * Créer un hôte virtuel `popbazar.local` pointant vers `/public`
   * Redémarrer les services WAMP

2. **Base de données** :

   * Créer une base `popbazar` dans phpMyAdmin
   * Importer le fichier `popbazar.sql` via l'onglet SQL
   * Identifiants utilisateurs précréés (voir instructions)

3. **Lancer le projet** :

   * Ouvrir [http://popbazar.local](http://popbazar.local) dans le navigateur

## Fonctionnalités principales

* **Navigation par catégorie** : Voir les annonces actives selon la catégorie
* **Section "Mes annonces"** : Voir, modifier, supprimer, ou marquer ses annonces comme vendues
* **Ajout et édition d'annonces** : Formulaires dynamiques avec validation serveur
* **Pagination** : Affichage par pages dans les listes d'annonces
* **Filtrage** : Toutes / Actives / Vendues
* **Consultation d’une annonce détaillée**
* **Authentification** : Inscription, connexion, déconnexion
* **Affichage du profil utilisateur**
* **Validation des formulaires** : Requises, messages d'erreur

## Structure du projet (MVC)

* `/controllers` : Logique des routes et des requêtes
* `/models` : Accès à la base de données via PDO
* `/views` : Vues dynamiques à partir de squelettes HTML
* `/utils` : Fonctions utilitaires, validation, gestion de session
* `/public` : Point d'entrée de l'application (index.php, CSS, images)
* `routes.php` : Définition des routes de l'application

## Git / Collaboration

* Projet géré avec **GitHub** 
* Travail en branches 
* Historique de commits clair et documenté


