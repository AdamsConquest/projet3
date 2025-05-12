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
    $catergoire =  Validation::valider_champs('name', obtenirParametre('categorie'), ['requis']);
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis']);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis']);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis']);
    $etat =  Validation::valider_champs('name', obtenirParametre('etat'), ['requis']);
  
    inspecter(obtenirParametre('categorie'));
    // if($catergoire && $titre && $description && $prix && $etat){
    //   $this->annonce->ajouter_annnonce(obtenirParametre('categorie'),obtenirParametre('titre'),obtenirParametre('description'),obtenirParametre('prix'),obtenirParametre('etat'));
    // }
    
    
   
    chargerVue("annonces/index", donnees: []);
  }
}
