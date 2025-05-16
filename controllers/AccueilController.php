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
    if (Session::est_connecte()) {
     redirect("annonces/ajouter");
    } else {
      Session::set_flash('Vous devez être connecté pour créer une annonce', 'danger');
      redirect("/connexion_user");
    }
  }

  public function afficherPageInscription()
  {
    chargerVue("utilisateur/inscription");
  }

  public function afficherPageConnexion()
  {
    chargerVue("utilisateur/connexion");
  }
}
