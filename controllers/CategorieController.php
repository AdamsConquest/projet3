<?php

/**
 * Contrôleur qui gère les opérations liées aux annonces par catégories.
 */
class CategorieController
{
  private $categorie; // Instance du modèle Categorie

  public function __construct()
  {
    require_once get_chemin_defaut('models/Categorie.php');
    $this->categorie = new Categorie();
  }

  /**
   * Affiche les annonces d’une catégorie donnée, avec pagination.
   *
   * @param array $params Paramètres de route, doit contenir 'id' (ID de la catégorie)
   * @return void
   */
  public function afficher_par_categorie($params)
  {
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
    $_SESSION['page'] = $page;

    $parPage = 9;
    $offset = ($page - 1) * $parPage;

    // Récupérer les annonces paginées pour la catégorie
    $stmt = $this->categorie->obtenir_annonce_par_categorie($params['id'], $parPage, $offset);
    $resultat = $stmt->fetchAll();

    // Calcul du nombre total de pages
    $total = $this->categorie->compter_annonces_par_categorie($params['id']);
    $totalPages = ceil($total / $parPage);

    // Chargement de la vue avec les données
    chargerVue("annonces/index", [
      "annonces" => $resultat,
      "page" => $page,
      "totalPages" => $totalPages,
      "idCategorie" => $params['id']
    ]);
  }
}
