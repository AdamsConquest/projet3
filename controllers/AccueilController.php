<?php

/**
 * Controller de la page d'accueil
 * 
 */

class AccueilController
{


  public function index()
  {
    chargerVue("accueil", [
      "titre" => "Accueil",
    ]);
  }

  public function ajouterAnnonce()
  {
    if (isset($_SESSION['id'])) {
      chargerVue("annonces/ajouter", []);
    } else {
      chargerVue("utilisateur/connexion", []);
    }
  }
}
