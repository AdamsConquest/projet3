<?php

/**
 * Classe Annonce
 * Modèle pour gérer les annonces par categorie dans la base de données
 * 
 */
class Categorie
{
  private $bd; // Connexion à la base de données

  public function __construct()
  {
    $config = require get_chemin_defaut('config/bd.php');
    require_once get_chemin_defaut('config/Database.php');

    $this->bd = new Database($config);  // Instance de la classe Database 
  }

  public function obtenir_annonce_par_categorie($idCategorie, $limite, $offset)
  {
    $sql = "SELECT * FROM produits WHERE categorie_id = ? LIMIT ? OFFSET ?";
    return $this->bd->requete($sql, [
      1 => $idCategorie,
      2 => $limite,
      3 => $offset
    ]);
  }

public function compter_annonces_par_categorie($idCategorie)
{
    $sql = "SELECT COUNT(*) as total FROM produits WHERE categorie_id = ?";
    $stmt = $this->bd->requete($sql, [1 => $idCategorie]);
    $row = $stmt->fetch();
    return (int)$row['total'];
}


}
