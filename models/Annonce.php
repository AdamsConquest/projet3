<?php

/**
 * Classe Annonce
 * Modèle pour gérer les annonces dans la base de données
 */
class Annonce
{
  private $bd; // Connexion à la base de données

  public function __construct()
  {
    $config = require get_chemin_defaut('config/bd.php');
    require_once get_chemin_defaut('config/Database.php');

    $this->bd = new Database($config);
  }

  /**
   * Ajoute une nouvelle annonce à la base de données.
   *
   * @param int $categorie ID de la catégorie
   * @param string $titre Titre de l'annonce
   * @param string $description Description complète de l'annonce
   * @param float $prix Prix du produit
   * @param string $etat État du produit (ex : neuf, usagé)
   * @return void
   */
  function ajouter_annnonce($categorie, $titre, $description, $prix, $etat)
  {
    $id = Session::obtenir_id_utilisateur();
    $sql = "INSERT INTO produits (utilisateur_id, categorie_id, titre, description, prix, etat, est_actif, est_vendu, nombre_vues) 
            VALUES (:id, :categorie, :titre, :description, :prix, :etat, :est_actif, :est_vendu, :nombre_vues)";
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

  /**
   * Récupère toutes les annonces d'un utilisateur.
   *
   * @param int $utilisateur_id ID de l'utilisateur
   * @return array Liste des annonces
   */
  public function get_annonces_par_utilisateur($utilisateur_id)
  {
    $sql = "SELECT * FROM produits WHERE utilisateur_id = :utilisateur_id ORDER BY date_creation DESC";
    $params = [":utilisateur_id" => $utilisateur_id];
    return $this->bd->requete($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Récupère une annonce par son ID.
   *
   * @param int $id ID de l'annonce
   * @return array Détails de l'annonce
   */
  public function get_annonce($id)
  {
    $sql = "SELECT * FROM produits WHERE id = ?";
    $stmt = $this->bd->requete($sql, ["1" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Modifie une annonce existante.
   *
   * @param int $id ID de l'annonce
   * @param string $titre Nouveau titre
   * @param string $description Nouvelle description
   * @param float $prix Nouveau prix
   * @param int $active 1 si active, 0 sinon
   * @param string $etat Nouvel état
   * @return void
   */
  public function modifier_annonce($id, $titre, $description, $prix, $active, $etat)
  {
    $sql = "UPDATE produits SET titre = ?, description = ?, prix = ?, est_actif = ?, etat = ? WHERE id = ?";
    $this->bd->requete($sql, ["1" => $titre, "2" => $description, "3" => $prix, "4" => $active, "5" => $etat, "6" => $id]);
  }

  /**
   * Supprime une annonce définitivement.
   *
   * @param int $id ID de l'annonce
   * @return void
   */
  public function supprimer_annonce($id)
  {
    $sql = "DELETE FROM produits WHERE id = ?";
    $this->bd->requete($sql, ["1" => $id]);
  }

  /**
   * Marque une annonce comme vendue.
   *
   * @param int $id ID de l'annonce
   * @return void
   */
  public function set_vendu_status($id)
  {
    $sql = "UPDATE produits SET est_vendu = ?, est_actif = ? WHERE id = ?";
    $this->bd->requete($sql, ["1" => 1, "2" => 0, "3" => $id]);
  }

  /**
   * Récupère les annonces d’un utilisateur avec pagination.
   *
   * @param int $idUtilisateur ID de l'utilisateur
   * @param int $limite Nombre de résultats par page
   * @param int $offset Décalage de départ
   * @return PDOStatement Résultat brut à traiter avec fetch
   */
  public function get_annonces_par_utilisateur_paginee($idUtilisateur, $limite, $offset)
  {
    $sql = "SELECT * FROM produits WHERE utilisateur_id = ? LIMIT ? OFFSET ?";
    return $this->bd->requete($sql, [1 => $idUtilisateur, 2 => $limite, 3 => $offset]);
  }

  /**
   * Compte le nombre total d'annonces d’un utilisateur.
   *
   * @param int $idUtilisateur ID de l'utilisateur
   * @return int Nombre d’annonces
   */
  public function count_annonces_utilisateur($idUtilisateur)
  {
    $sql = "SELECT COUNT(*) as total FROM produits WHERE utilisateur_id = ?";
    $stmt = $this->bd->requete($sql, [1 => $idUtilisateur]);
    $row = $stmt->fetch();
    return (int)$row['total'];
  }
}
