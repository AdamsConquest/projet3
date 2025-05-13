<?php

/**
 * Classe Annonce
 * Modèle pour gérer les utilisateurs dans la base de données
 */

class Utilisateur
{
  private $bd; // Connexion à la base de données

  public function __construct()
  {
    $config = require get_chemin_defaut('config/bd.php');
    require_once get_chemin_defaut('config/Database.php');

    $this->bd = new Database($config); // Instance de la classe Database
  }

  function ajouter_Utilisateur($prenom, $nom, $nom_utilisateur, $courriel, $mot_de_passe)
  {
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $nom_table = "utilisateurs";
    $sql = "INSERT INTO  $nom_table (nom_utilisateur, email, hashed_password  ,prenom, nom) VALUES (:nom_utilisateur, :courriel, :mot_de_passe, :prenom, :nom)";
    $params = [
      ":nom_utilisateur" => $nom_utilisateur,
      ":email" => $courriel,
      ":mot_de_passe" => $hashed_password,
      ":prenom" => $prenom,
      ":nom" => $nom
    ];
    $this->bd->requete($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }
}
