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
    chargerVue("annonces/index", donnees: []);
  }

  public function ajouterUneAnnonce()
  {
    $catergoire =  Validation::valider_champs('name', obtenirParametre('categorie'), ['requis' => true]);
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis' => true]);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis' => true]);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis' => true]);
    $etat =  Validation::valider_champs('name', obtenirParametre('etat'), ['requis' => true]);

    if ($catergoire && $titre && $description && $prix && $etat) {
      $this->annonce->ajouter_annnonce(obtenir_id_categorie(obtenirParametre('categorie')), obtenirParametre('titre'), obtenirParametre('description'), obtenirParametre('prix'), obtenirParametre('etat'));
    }
    chargerVue("annonces/index", donnees: []);

  }

  public function afficher_par_annonce($params)
  {

    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/afficher", donnees: [
      "titre" => "Annonce"
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

  public function modifier_une_annonce($params)
  {

    $categorie = obtenir_id_categorie(obtenirParametre('categorie'));
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis' => true]);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis' => true]);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis' => true]);
    $active = Validation::valider_champs('name', obtenirParametre('est_actif') ? 1 : 0, ['requis' => true]);
    $etat = Validation::valider_champs('name', obtenirParametre('etat'), ['requis' => true]);

    
    if ($categorie && $titre && $description && $prix && $active && $etat) {
      $this->annonce->modifier_annonce($params['id'], obtenirParametre('titre'), obtenirParametre('description'), obtenirParametre('prix'), obtenirParametre('est_actif') ? 1 : 0, obtenirParametre('etat'));
      $donnees = $this->annonce->get_annonce($params['id']);
      chargerVue("annonces/afficher", donnees: [
        "titre" => "Annonce",
        "annonce" => $donnees[0],
      ]);
    }
  }

  public function supprimer_une_annonce($params) {
    
  }
}
