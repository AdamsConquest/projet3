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
    if (!Session::est_connecte()) {
      redirect("/connexion_user");
      return;
    }

    $utilisateur_id = Session::obtenir_id_utilisateur();
    $annonces = $this->annonce->get_annonces_par_utilisateur($utilisateur_id);

    chargerVue("annonces/index", donnees: [
      "annonces" => $annonces
    ]);
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
      Session::set_flash('Annonce ajouté avec succès.', 'success');
    }
    redirect('/MesAnnonces');
  }

  public function afficher_par_annonce($params)
  {

    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/afficher", donnees: [
      "annonce" => $donnees[0]
    ]);
  }

  public function afficher_modification($params)
  {
    $donnees = $this->annonce->get_annonce($params['id']);

    if (Session::est_connecte()) {
      if ($donnees[0]['utilisateur_id'] === Session::obtenir_id_utilisateur()) {
        chargerVue("annonces/modifier", donnees: [
          "titre" => "Annonce",
          "annonce" => $donnees[0],
        ]);
      } else {
        Session::set_flash('Vous n\'êtes pas autorisé à modifier cette annonce.', 'danger');
        redirect('/MesAnnonces');
      }
    } else {
      Session::set_flash('Vous devez être connecté pour modifier une annonce', 'danger');
      redirect('/connexion_user');
    }
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

  public function marquer_vendu($params)
  {
    $this->annonce->set_vendu_status($params['id']);
    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/afficher", donnees: [
      "titre" => "Annonce",
      "annonce" => $donnees[0],
    ]);
  }

  public function supprimer_une_annonce($params)
  {

    // Récupérer l'ID de l'utilisateur connecté
    $utilisateur_id = Session::obtenir_id_utilisateur();

    // Vérifier si l'annonce appartient à l'utilisateur connecté
    $annonce = $this->annonce->get_annonce($params['id']);

    if ($annonce[0]['utilisateur_id'] == $utilisateur_id) {
      // Supprimer l'annonce
      $this->annonce->supprimer_annonce($params['id']);
      // Ajouter un message flash de succès
      Session::set_flash('Annonce supprimée avec succès.', 'success');
      redirect('/MesAnnonces');
    } else {
      Session::set_flash('Vous n\'êtes pas autorisé à supprimer cette annonce.', 'error');
      redirect('/MesAnnonces');
    }
  }
}
