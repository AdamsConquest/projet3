<?php

/**
 * Classe Categorie
 * Modèle pour gérer les annonces par catégorie dans la base de données
 */
class Categorie
{
  private $bd; // Connexion à la base de données

  public function __construct()
  {
    $config = require get_chemin_defaut('config/bd.php');
    require_once get_chemin_defaut('config/Database.php');

    $this->bd = new Database($config);
  }

  /**
   * Récupère les annonces associées à une catégorie spécifique avec pagination.
   *
   * @param int $idCategorie ID de la catégorie
   * @param int $limite Nombre d’annonces à afficher par page
   * @param int $offset Décalage de départ pour la pagination
   * @return PDOStatement Résultat à traiter avec fetch/fetchAll
   */
  public function obtenir_annonce_par_categorie($idCategorie, $limite, $offset)
  {
    $sql = "SELECT * FROM produits WHERE categorie_id = ? LIMIT ? OFFSET ?";
    return $this->bd->requete($sql, [
      1 => $idCategorie,
      2 => $limite,
      3 => $offset
    ]);
  }

  /**
   * Compte le nombre total d’annonces dans une catégorie donnée.
   *
   * @param int $idCategorie ID de la catégorie
   * @return int Nombre d’annonces trouvées
   */
  public function compter_annonces_par_categorie($idCategorie)
  {
    $sql = "SELECT COUNT(*) as total FROM produits WHERE categorie_id = ?";
    $stmt = $this->bd->requete($sql, [1 => $idCategorie]);
    $row = $stmt->fetch();
    return (int)$row['total'];
  }
}
