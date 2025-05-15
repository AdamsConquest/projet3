<?php

/**
 * Controller de qui gère les opérations liées aux annonces comme l'affichage, la création, la modification, la suppression, etc.
 * 
 */

class AnnonceController
{

  private $annonce; // représente l'instance du modèle Annonce

  public function __construct()
  {
    // Instancie le modèle Annonce
    require_once get_chemin_defaut('models/Annonce.php');
    $this->annonce = new Annonce(); // instance du modèle Annonce
  }

  //afficher annonces par utilisateur
  public function afficher_par_utilisateur($params)
  {
    chargerVue("annonces/index", donnees: [
      "annonces" => null
    ]);
  }

  public function afficher_par_annonce($params)
  {

    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/afficher", donnees: [
      "titre" => "Annonce",
      "annonce" => $donnees[0],
    ]);
  }

  public function afficher_modification($params)
  {

    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/modifier", donnees: [
      "titre" => "Annonce",
      "annonce" => $donnees[0],
    ]);
  }

  public function modifier_une_annonce()
  {
    $id = obtenir_id_categorie(obtenirParametre('categorie'));
    $titre = obtenirParametre('titre');
    $description = obtenirParametre('description');
    $prix = obtenirParametre('prix');
    $active = obtenirParametre('est_actif') ? 1 : 0;
    $etat = obtenirParametre('etat');

    if (1) {
      $this->annonce->modifier_annonce($id, $titre, $description, $prix, $active, $etat);
      $donnees = $this->annonce->get_annonce($id);
      chargerVue("annonces/afficher", donnees: [
        "titre" => "Annonce",
        "annonce" => $donnees[0],
      ]);
    }



  }
}
