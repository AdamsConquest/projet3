<?php

/**
 * Routes
 * 
 * Ce fichier contient la liste des routes de l'application
 * Chaque route est associée à un contrôleur et une méthode
 */

// Routes principales
$routeur->get("/", "AccueilController@index");

// Routes d'authentification
$routeur->get("/connexion_user", "AccueilController@afficherPageConnexion");
$routeur->post("/connexion_user", "UtilisateurController@connexion_utilisteur");
$routeur->get("/inscription", "AccueilController@afficherPageInscription");

$routeur->post("/inscription_User", "UtilisateurController@inscrire_utilisateur");

$routeur->post("/deconnexion_user", "UtilisateurController@deconnexion_utilisteur");

// Routes des annonces
$routeur->get("/MesAnnonces", "AnnonceController@afficher_par_utilisateur");
$routeur->get("/annonces/{id}", "AnnonceController@afficher_par_annonce");
$routeur->post("/annonces", "AnnonceController@ajouterUneAnnonce");
$routeur->get("/ajouter_annonce", "AccueilController@ajouterAnnonce");


// Routes de modification/suppression des annonces
$routeur->get("/annonces/{id}/modifier", "AnnonceController@afficher_modification");
$routeur->post("/annonces/{id}/modifier", "AnnonceController@modifier_une_annonce");
$routeur->post("/annonces/{id}/supprimer", "AnnonceController@supprimer_une_annonce");
$routeur->post("/annonces/{id}/est_vendu", "AnnonceController@marquer_vendu");

//Profile
$routeur->get("/profil", "ProfilController@afficher");

// Routes des catégories
$routeur->get("/categories/{id}/annonces", "CategorieController@afficher_par_categorie");