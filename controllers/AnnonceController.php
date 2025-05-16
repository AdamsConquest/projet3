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
      $this->annonce->ajouter_annnonce(obtenir_id_categorie($categorie), $titre, $description, $prix, $etat);
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

    if (Session::est_connecte()) {
      if ($donnees[0]['utilisateur_id'] === Session::obtenir_id_utilisateur()) {
        chargerVue("annonces/modifier", [
          "titre" => "Annonce",
          "annonce" => $donnees[0],
        ]);
      } else {
        Session::set_flash("Vous n'êtes pas autorisé à modifier cette annonce.", 'danger');
        redirect('/MesAnnonces');
      }
    } else {
      Session::set_flash("Vous devez être connecté pour modifier une annonce", 'danger');
      redirect('/connexion_user');
    }
  }

  /**
   * Affiche à nouveau le formulaire de modification (doublon possible à fusionner).
   *
   * @param array $params Paramètres de route
   * @return void
   */
  public function afficher_modification($params)
  {
    $this->afficher_par_annonce($params);
  }

  /**
   * Enregistre les modifications d'une annonce dans la base de données.
   *
   * @param array $params Paramètres de route (doit contenir 'id')
   * @return void
   */
  public function modifier_une_annonce($params)
  {
    $categorie = obtenir_id_categorie(obtenirParametre('categorie'));
    $titre = Validation::valider_champs('name', obtenirParametre('titre'), ['requis' => true]);
    $description = Validation::valider_champs('name', obtenirParametre('description'), ['requis' => true]);
    $prix = Validation::valider_champs('name', obtenirParametre('prix'), ['requis' => true]);
    $active = Validation::valider_champs('name', obtenirParametre('est_actif') ? 1 : 0, ['requis' => true]);
    $etat = Validation::valider_champs('name', obtenirParametre('etat'), ['requis' => true]);

    if ($categorie && $titre && $description && $prix && $active && $etat) {
      $this->annonce->modifier_annonce(
        $params['id'],
        $titre,
        $description,
        $prix,
        $active,
        $etat
      );
      $donnees = $this->annonce->get_annonce($params['id']);
      chargerVue("annonces/afficher", [
        "titre" => "Annonce",
        "annonce" => $donnees[0],
      ]);
    }
  }

  /**
   * Marque une annonce comme vendue.
   *
   * @param array $params Paramètres de route (doit contenir 'id')
   * @return void
   */
  public function marquer_vendu($params)
  {
    $this->annonce->set_vendu_status($params['id']);
    $donnees = $this->annonce->get_annonce($params['id']);
    chargerVue("annonces/afficher", [
      "titre" => "Annonce",
      "annonce" => $donnees[0],
    ]);
  }

  /**
   * Supprime une annonce si elle appartient à l'utilisateur connecté.
   *
   * @param array $params Paramètres de route (doit contenir 'id')
   * @return void
   */
  public function supprimer_une_annonce($params)
  {
    $utilisateur_id = Session::obtenir_id_utilisateur();
    $annonce = $this->annonce->get_annonce($params['id']);

    if ($annonce[0]['utilisateur_id'] == $utilisateur_id) {
      $this->annonce->supprimer_annonce($params['id']);
      Session::set_flash('Annonce supprimée avec succès.', 'success');
    } else {
      Session::set_flash("Vous n'êtes pas autorisé à supprimer cette annonce.", 'error');
    }

    redirect('/MesAnnonces');
  }
}
