<?php

/**
 * Contrôleur Utilisateur qui permet de gérer les utilisateurs comme l'inscription, la connexion, la déconnexion, etc.
 */

class UtilisateurController

{

  private $utilisateur; // représente l'instance du modèle utilisateur

  public function __construct()
  {
    // Instancie le modèle Utilisateur
    require_once get_chemin_defaut('models/Utilisateur.php');
    $this->utilisateur = new Utilisateur(); // instance du modèle Utilisateur
  }

  public function inscrire_utilisateur()
  {
    $Prénom =  Validation::valider_champs('name', obtenirParametre('firstname'), ['requis']);
    $nom = Validation::valider_champs('name', obtenirParametre('lastname'), ['requis']);
    $nom_utilisateur = Validation::valider_champs('name', obtenirParametre('nom_utilisateur'), ['requis']);
    $courriel = Validation::valider_champs('name', obtenirParametre('email'), ['requis']);
    $mot_de_passe =  Validation::valider_champs('mot de passe', obtenirParametre('mot_passe'), ['min' => 2, 'max' => 50]);
    inspecter($mot_de_passe);
  }
}
