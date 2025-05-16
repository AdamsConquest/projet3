<?php

/**
 * Controleur qui gère les opérations liées aux annonces par catégories
 * 
 */
class CategorieController
{

  private $categorie; // représente l'instance du modèle Categorie

  public function __construct()
  {
    // Instancie le modèle Annonce
    require_once get_chemin_defaut('models/Categorie.php');
    $this->categorie = new Categorie(); // instance du modèle Categorie
  }

  //afficher annonces par categorie
  // public function afficher_par_categorie($params)
  // {
  //   $resultat = $this->categorie->obtenir_annonce_par_categorie($params['id']);
  //   chargerVue("annonces/index", donnees: [
  //     "annonces" => $resultat
  //   ]); 
  // }

public function afficher_par_categorie($params)
{
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $parPage = 9;
    $offset = ($page - 1) * $parPage;

    // Exécuter la requête et récupérer les résultats
    $stmt = $this->categorie->obtenir_annonce_par_categorie($params['id'], $parPage, $offset);
    $resultat = $stmt->fetchAll(); 

    $total = $this->categorie->compter_annonces_par_categorie($params['id']);
    $totalPages = ceil($total / $parPage);

    chargerVue("annonces/index", donnees: [
        "annonces" => $resultat,
        "page" => $page,
        "totalPages" => $totalPages,
        "idCategorie" => $params['id']
    ]);
}


}
