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
    $prenom =  Validation::valider_champs('nom', obtenirParametre('prenom'), ['requis' => true]);
    $nom = Validation::valider_champs('nom de famille ', obtenirParametre('nom'), ['requis' => true]);
    $nom_utilisateur = Validation::valider_champs('nom d\'utlisateur', obtenirParametre('nom_utilisateur'), ['requis' => true]);
    $courriel = Validation::valider_champs('email', obtenirParametre('email'), ['requis' => true]);
    $mot_de_passe =  Validation::valider_champs('password', obtenirParametre('confirmation_mot_passe'), [
      'requis' => true,
      'majuscule' => true, 
      'chiffre' => true,
      'special' => true,
      'min' => 8
    ]);
    $mot_de_passe_confirmer = obtenirParametre('confirmation_mot_passe');

    if ($prenom && $nom &&  $nom_utilisateur && $courriel && $mot_de_passe) {
      if ($mot_de_passe ==  $mot_de_passe_confirmer) {
        $this->utilisateur->ajouter_Utilisateur(obtenirParametre('prenom'), obtenirParametre('nom'), obtenirParametre('nom_utilisateur'), obtenirParametre('email'), obtenirParametre('mot_passe'));
        chargerVue("annonces/index", donnees: []);
      } else {
        //passwo  rds dont match
        inspecter("passwords dont match");
      }
    }
  }
}
