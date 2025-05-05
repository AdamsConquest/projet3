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

  function obtenir_annonce_par_categorie($id_categorie, $nom_table = "produits")
  {
    $sql = "SELECT * FROM $nom_table where categorie_id = :id_categorie";
    $params = [":id_categorie"=>$id_categorie];
    return $this->bd->requete($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    
  }
}
