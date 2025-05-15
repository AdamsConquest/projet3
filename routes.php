<?php

/**
 * Routes
 * 
 * Ce fichier contient la liste des routes de l'application
 * 
 * Chaque route est associée à un contrôleur et une méthode de controlleur
 * 
 * exemple : $routeur->get("/annonces", "AnnonceController@index")
 *           $routeur->get("/annonces/{id}", "AnnonceController@afficher");
 */

$routeur->get("/", "AccueilController@index");
$routeur->get("/categories/{id}/annonces","CategorieController@afficher_par_categorie");
$routeur->get("/MesAnnonces","AnnonceController@afficher_par_utilisateur");

$routeur->get("/annonces/{id}", "AnnonceController@afficher_par_annonce");
$routeur->get("/annonces/{id}/modifier", "AnnonceController@afficher_modification");

$routeur->POST("/annonces/{id}/modifier", "AnnonceController@modifier_une_annonce");
$routeur->POST("/annonces/{id}", "AnnonceController@afficher_par_annonce");


$routeur->get("/ajouter","AccueilController@ajouterAnnonce");

$routeur->get("/annonces/{id}", "AnnonceController@afficher_par_annonce");

$routeur->get("/connexion_user", "AccueilController@afficherPageConnexion");
$routeur->get("/inscription", "AccueilController@afficherPageInscription");

$routeur->get("/deconnexion_user", "UtilisateurController@deconnexion_utilisteur");
$routeur->post("/deconnexion", "UtilisateurController@deconnexion_utilisteur");




$routeur->post("/annonces","AnnonceController@ajouterUneAnnonce");
$routeur->post("/inscription_User","UtilisateurController@inscrire_utilisateur");
$routeur->post("/connexion_user","UtilisateurController@connexion_utilisteur");

