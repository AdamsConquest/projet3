<?php

/**
 * Classe Utilisateur
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

  /**
   * Ajoute un nouvel utilisateur dans la base de données.
   *
   * @param string $prenom Prénom de l'utilisateur
   * @param string $nom Nom de famille de l'utilisateur
   * @param string $nom_utilisateur Nom d'utilisateur
   * @param string $courriel Adresse email
   * @param string $mot_de_passe Mot de passe en clair (sera haché)
   * @return void
   */
  function ajouter_Utilisateur($prenom, $nom, $nom_utilisateur, $courriel, $mot_de_passe)
  {
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe_hash, prenom, nom, telephone) 
            VALUES (:nom_utilisateur, :email, :hashed_password, :prenom, :nom, :telephone)";

    $params = [
      ":nom_utilisateur" => $nom_utilisateur,
      ":email" => $courriel,
      ":hashed_password" => $hashed_password,
      ":prenom" => $prenom,
      ":nom" => $nom,
      ":telephone" => ''
    ];
    $this->bd->requete($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Vérifie si un utilisateur existe dans la base de données selon son email.
   *
   * @param string $email Email à vérifier
   * @return array Résultat contenant l'utilisateur s'il existe
   */
  function utilisateur_dans_BD($email)
  {
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $params = [":email" => $email];
    return $this->bd->requete($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Récupère les informations d’un utilisateur par son ID.
   *
   * @param int $id ID de l'utilisateur
   * @return array|null Informations de l'utilisateur ou null si non trouvé
   */
  function obtenir_utilisateur_par_id($id)
  {
    $sql = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $this->bd->requete($sql, [1 => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
