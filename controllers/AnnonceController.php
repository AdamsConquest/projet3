<?php

/**
 * Contrôleur qui gère les opérations liées aux annonces : affichage, création, modification, suppression, etc.
 */
class AnnonceController
{
  private $annonce; // Instance du modèle Annonce

  public function __construct()
  {
    require_once get_chemin_defaut('models/Annonce.php');
    $this->annonce = new Annonce();
  }

  /**
   * Affiche les annonces de l'utilisateur connecté, avec pagination.
   *
   * @param array $params Paramètres de route
   * @return void
   */
  public function afficher_par_utilisateur($params)
  {
    if (!Session::est_connecte()) {
      redirect("/connexion_user");
      return;
    }

    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
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

  /**
   * Traite l'ajout d'une annonce depuis un formulaire.
   *
   * @return void
   */
  public function ajouterUneAnnonce()
  {
    $categorie = Validation::valider_champs('name', obtenirParametre('categorie'), ['requis' => true]);
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis' => true]);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis' => true]);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis' => true]);
    $etat = Validation::valider_champs('name', obtenirParametre('etat'), ['requis' => true]);

    if ($categorie && $titre && $description && $prix && $etat) {
      $this->annonce->ajouter_annnonce(obtenir_id_categorie(obtenirParametre('categorie')), obtenirParametre('titre'), obtenirParametre('description'), obtenirParametre('prix'), obtenirParametre('etat'));
      Session::set_flash('Annonce ajoutée avec succès.', 'success');
    }
    redirect('/MesAnnonces');
  }

  /**
   * Affiche le formulaire de modification d'une annonce si l'utilisateur est autorisé.
   *
   * @param array $params Paramètres de route (doit contenir 'id')
   * @return void
   */
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
    $utilisateur_id = Session::obtenir_id_utilisateur();
    $annonce = $this->annonce->get_annonce($params['id']);

    if ($annonce[0]['utilisateur_id'] == $utilisateur_id) {
      $this->annonce->supprimer_annonce($params['id']);
      Session::set_flash('Annonce supprimée avec succès.', 'success');
      redirect('/MesAnnonces');
    } else {
      Session::set_flash('Vous n\'êtes pas autorisé à supprimer cette annonce.', 'error');
      redirect('/MesAnnonces');
    }
  }
}
