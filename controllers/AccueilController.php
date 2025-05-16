<?php

/**
 * Controller de la page d'accueil
 * Gère l'affichage de la page d'accueil et les redirections liées à l'inscription, la connexion et l'ajout d'annonce.
 */
class AccueilController
{
  /**
   * Affiche la page d'accueil.
   *
   * @return void
   */
  public function index()
  {
    chargerVue("accueil", [
      "titre" => "Accueil",
    ]);
  }

  /**
   * Redirige vers la page d'ajout d'annonce si l'utilisateur est connecté,
   * sinon vers la page de connexion avec un message flash.
   *
   * @return void
   */
  public function ajouterAnnonce()
  {
    if (Session::est_connecte()) {
     chargerVue("annonces/ajouter");
    } else {
      Session::set_flash('Vous devez être connecté pour créer une annonce', 'danger');
      redirect("/connexion_user");
    }
  }

  /**
   * Affiche la page d'inscription.
   *
   * @return void
   */
  public function afficherPageInscription()
  {
    chargerVue("utilisateur/inscription");
  }

  /**
   * Affiche la page de connexion.
   *
   * @return void
   */
  public function afficherPageConnexion()
  {
    chargerVue("utilisateur/connexion");
  }
}
