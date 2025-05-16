<?php

/**
 * Controleur qui gère les opérations liées au profil utilisateur
 */

class ProfilController
{

  public function __construct()
  {
  }

  public function afficher()
  {
    if (!Session::est_connecte()) {
      redirect("/connexion_user");
      return;
    }

    //$utilisateur_id = Session::obtenir_id_utilisateur();
    $nom = Session::obtenir_nom();
    $prenom = Session::obtenir_prenom();
    $nom_utilisateur = Session::obtenir_nom_utilisateur();
    $courriel = Session::obtenir_email_utilisateur();

    chargerVue("utilisateur/profil", [
      "nom"=>$nom,
      "prenom"=>$prenom,
      "nom_utilisateur"=>$nom_utilisateur,
      "courriel"=>$courriel
    ]);


  }
}
