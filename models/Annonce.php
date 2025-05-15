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


  function ajouter_annnonce($categorie, $titre, $description, $prix, $etat)
  {
    inspecter(Session::obtenir_id_utilisateur());
    $id = Session::obtenir_id_utilisateur();
    $nom_table = "produits";
    $sql = "INSERT INTO  $nom_table (utilisateur_id, categorie_id ,titre, description, prix, etat, est_actif, est_vendu ,nombre_vues) VALUES (:id, :categorie, :titre, :description, :prix, :etat,:est_actif ,:est_vendu ,:nombre_vues)";
    $params = [
      ":id" => $id,
      ":categorie" => $categorie,
      ":titre" => $titre,
      ":description" => $description,
      ":prix" => $prix,
      ":etat" => $etat,
      ":est_actif" => 1, 
      ":est_vendu" => 0,
      ":nombre_vues" => 0
    ];
    $this->bd->requete($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_annonce($id)
  {
    $sql = "SELECT * FROM produits WHERE id = ?";
    $stmt = $this->bd->requete($sql, params: ["1" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }



  public function modifier_annonce($id, $titre, $description, $prix, $active, $etat)
  {
    $sql = "UPDATE produits SET titre = ?, description = ?, prix = ?, est_actif = ?, etat = ? WHERE id = ?";
    $stmt = $this->bd->requete($sql, params: ["1" => $titre, "2" => $description, "3" => $prix, "4" => $active, "5" => $etat, "6" => $id]);
  }

  public function supprimer_annonce($id)
  {
    $sql = "DELETE FROM produits WHERE id = ?";
    $stmt = $this->bd->requete($sql, [$id]);
  }
}
