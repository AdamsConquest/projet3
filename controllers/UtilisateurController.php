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
    $prenom =  Validation::valider_champs('nom', obtenirParametre('firstname'), ['requis' => true]);
    $nom = Validation::valider_champs('nom de famille ', obtenirParametre('lastname'), ['requis' => true]);
    $nom_utilisateur = Validation::valider_champs('nom d utlisateur', obtenirParametre('nom_utilisateur'), ['requis' => true]);
    $courriel = Validation::valider_champs('email', obtenirParametre('email'), ['requis' => true]);
    $mot_de_passe =  Validation::valider_champs('mot de passe', obtenirParametre('mot_passe'), ['majuscule' => true, 'chiffre' => true, 'special' => true, 'min' => 4, 'max' => 50]);
    $mot_de_passe_confirmer = obtenirParametre('confirm-password');

    if ($prenom && $nom &&  $nom_utilisateur && $courriel && $mot_de_passe) {
      if ($mot_de_passe ==  $mot_de_passe_confirmer) {
        $this->utilisateur->ajouter_Utilisateur(obtenir_id_categorie(obtenirParametre('firstname')), obtenirParametre('lastname'), obtenirParametre('nom_utilisateur'), obtenirParametre('email'), obtenirParametre('mot_passe'));
        chargerVue("annonces/index", donnees: []);
      } else {
        //passwo  rds dont match
      }
    }
  }
}
