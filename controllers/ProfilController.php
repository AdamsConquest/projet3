<?php

/**
 * Contrôleur qui gère les opérations liées au profil utilisateur.
 */
class ProfilController
{
  /**
   * Constructeur vide — peut être utilisé pour initialiser un modèle si nécessaire.
   */
  public function __construct()
  {
  }

  /**
   * Affiche les informations du profil de l'utilisateur connecté.
   * Redirige vers la page de connexion si l'utilisateur n'est pas authentifié.
   *
   * @return void
   */
  public function afficher()
  {
    if (!Session::est_connecte()) {
      redirect("/connexion_user");
      return;
    }

    $nom = Session::obtenir_nom();
    $prenom = Session::obtenir_prenom();
    $nom_utilisateur = Session::obtenir_nom_utilisateur();
    $courriel = Session::obtenir_email_utilisateur();

    chargerVue("utilisateur/profil", [
      "nom" => $nom,
      "prenom" => $prenom,
      "nom_utilisateur" => $nom_utilisateur,
      "courriel" => $courriel
    ]);
  }
}
