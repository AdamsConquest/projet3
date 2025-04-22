<?php

require_once '../utils/index.php';
require_once get_chemin_defaut("utils/Validation.php");
require_once get_chemin_defaut("utils/Session.php");
require_once get_chemin_defaut("config/Database.php");
require_once get_chemin_defaut("Routeur.php");

// Démarre la session
Session::demarrer();

// Instancie le Routeur
$routeur = new Routeur();


// Charge les routes
$route = require_once get_chemin_defaut("routes.php");

// Extraire l'URI de la requête
$uri = $_SERVER['REQUEST_URI'];

// Execute le contrôleur correspondant à la route
$routeur->route($uri);   
