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

  public function connexion_utilisteur()
  {
    $champ_email = obtenirParametre('email');
    $champ_password = obtenirParametre('mot_passe');

    $Verification_email = Validation::valider_champs('email', $champ_email, ['requis' => true]);
    $Verification_password =   Validation::valider_champs('mot de passe', $champ_password, ['requis' => true]);

    if ($Verification_email && $Verification_password) {
      $user = $this->utilisateur->utilisateur_dans_BD($champ_email);
      $email = $user[0]['email'];
      $password = $user[0]['mot_de_passe_hash'];

      if ($email == $champ_email && password_verify($champ_password, $password)) {
        Session::set('id_utilisateur', $this->utilisateur->utilisateur_dans_BD(obtenirParametre('email'))[0]['id']);
        inspecter($_SESSION);
        chargerVue("annonces/index", donnees: []);
      } else {
        chargerVue("utilisateur/connexion", donnees: []);
      }
    }
  }

  public function deconnexion_utilisteur()
  {
    inspecter(Session::est_connecte());
    if (Session::est_connecte()) {

      Session::detruire();
      Session::demarrer();
      redirect("/");  
    }
    else{
       redirect("/");
    }
  }
}
