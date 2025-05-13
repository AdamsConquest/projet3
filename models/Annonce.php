<?php

/**
 * Classe Annonce
 * Modèle pour gérer les annonces dans la base de données
 * 
 */

class Annonce
{
  private $bd; // Connexion à la base de données

  public function __construct()
  {
    $config = require get_chemin_defaut('config/bd.php');
    require_once get_chemin_defaut('config/Database.php');

    $this->bd = new Database($config); // Instance de la classe Database 
  }

  public function get_annonce($id) {
    $sql = "SELECT * FROM produits WHERE id = ?";
    $stmt = $this->bd->requete($sql, params: ["1" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

public function modifier_annonce($id, $titre, $description, $prix, $active, $etat) {
    $sql = "UPDATE produits SET titre = ?, description = ?, prix = ?, est_actif = ?, etat = ? WHERE id = ?";
    $stmt = $this->bd->requete($sql, params: ["1"=>$titre, "2"=>$description, "3"=>$prix, "4"=>$active, "5"=>$etat, "6"=>$id]); 
}




  
}
