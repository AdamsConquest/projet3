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

    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
    $_SESSION['page'] = $page;

    $parPage = 9;
    $offset = ($page - 1) * $parPage;

    $utilisateur_id = Session::obtenir_id_utilisateur();

    $stmt = $this->annonce->get_annonces_par_utilisateur_paginee($utilisateur_id, $parPage, $offset);
    $annonces = $stmt->fetchAll();

    $total = $this->annonce->count_annonces_utilisateur($utilisateur_id);
    $totalPages = ceil($total / $parPage);

    chargerVue("annonces/index", [
      "annonces" => $annonces,
      "page" => $page,
      "totalPages" => $totalPages
    ]);
  }



  public function ajouterUneAnnonce()
  {
    $catergoire = Validation::valider_champs('name', obtenirParametre('categorie'), ['requis' => true]);
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis' => true]);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis' => true]);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis' => true]);
    $etat = Validation::valider_champs('name', obtenirParametre('etat'), ['requis' => true]);

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
      "titre" => "Annonce",
      "annonce" => $donnees[0],
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


    $categorie = Validation::valider_champs('catégorie', obtenirParametre('categorie'), ['requis' => true]);
    $titre = Validation::valider_champs('titre', obtenirParametre('titre'), ['requis' => true, 'max' => 70]);
    $description = Validation::valider_champs('description', obtenirParametre('description'), ['requis' => true, 'min' => 30]);
    $prix = Validation::valider_champs('prix', obtenirParametre('prix'), ['requis' => true]);
    $etat = Validation::valider_champs('état', obtenirParametre('etat'), ['requis' => true]);


    // Check for validation errors
    if (is_string($titre)) {
      Session::set_flash('Le titre est invalide (70 caractères maximum)', 'warning');
      redirect("/annonces/{$params['id']}/modifier");
      return;
    }
    if (is_string($description)) {
      Session::set_flash('La description est invalide (30 caractères maximum)', 'warning');
      redirect("/annonces/{$params['id']}/modifier");
      return;
    }



    if ($titre && $description) {

      $this->annonce->modifier_annonce($params['id'], obtenirParametre('titre'), obtenirParametre('description'), obtenirParametre('prix'), obtenirParametre('est_actif') ? 1 : 0, obtenirParametre('etat'), obtenirParametre('categorie'));
      //$this->annonce->get_annonce($params['id']);

      Session::set_flash('Annonce modifiée avec succès', 'success');
      redirect('/MesAnnonces');
    }
  }

  public function marquer_vendu($params)
  {
    $this->annonce->set_vendu_status($params['id']);
    $donnees = $this->annonce->get_annonce($params['id']);
    redirect('/MesAnnonces');
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
