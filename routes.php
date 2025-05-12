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