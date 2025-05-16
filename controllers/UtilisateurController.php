<?php

/**
 * Contrôleur Utilisateur qui permet de gérer les utilisateurs : inscription, connexion, déconnexion, etc.
 */
class UtilisateurController
{
  private $utilisateur; // Instance du modèle Utilisateur

  /**
   * Initialise le modèle Utilisateur.
   */
  public function __construct()
  {
    require_once get_chemin_defaut('models/Utilisateur.php');
    $this->utilisateur = new Utilisateur();
  }

  /**
   * Inscrit un nouvel utilisateur s’il remplit les conditions de validation.
   * S’il est inscrit avec succès, il est automatiquement connecté.
   *
   * @return void
   */
  public function inscrire_utilisateur()
  {
    $prenom = Validation::valider_champs('nom', obtenirParametre('prenom'), ['requis' => true]);
    $nom = Validation::valider_champs('nom de famille', obtenirParametre('nom'), ['requis' => true]);
    $nom_utilisateur = Validation::valider_champs('nom d\'utilisateur', obtenirParametre('nom_utilisateur'), ['requis' => true]);
    $courriel = Validation::valider_champs('email', obtenirParametre('email'), ['requis' => true]);
    $mot_de_passe = Validation::valider_champs('password', obtenirParametre('mot_passe'), [
      'requis' => true, 'majuscule' => true, 'chiffre' => true, 'special' => true, 'min' => 8
    ]);
    $mot_de_passe_confirmer = obtenirParametre('confirmation_mot_passe');

    if ($prenom && $nom && $nom_utilisateur && $courriel && $mot_de_passe) {
      if ($mot_de_passe == $mot_de_passe_confirmer) {
        $this->utilisateur->ajouter_Utilisateur($prenom, $nom, $nom_utilisateur, $courriel, $mot_de_passe);
        $nouveau_utilisateur = $this->utilisateur->utilisateur_dans_BD($courriel);

        if ($nouveau_utilisateur) {
          Session::set('id_utilisateur', [
            'id' => $nouveau_utilisateur[0]['id'],
            'nom_utilisateur' => $nouveau_utilisateur[0]['nom_utilisateur'],
            'email' => $nouveau_utilisateur[0]['email'],
            'nom' => $nouveau_utilisateur[0]['nom'],
            'prenom' => $nouveau_utilisateur[0]['prenom']
          ]);
          redirect('/MesAnnonces');
        }
      } else {
        chargerVue("utilisateur/inscription", donnees: [
          'erreur' => 'Les mots de passe ne correspondent pas',
          'prenom' => $prenom,
          'nom' => $nom,
          'email' => $courriel,
          'nom_utilisateur' => $nom_utilisateur
        ]);
      }
    }
  }

  /**
   * Connecte un utilisateur à partir des informations fournies dans le formulaire.
   * Si la combinaison email/mot de passe est valide, la session est initialisée.
   *
   * @return void
   */
  public function connexion_utilisteur()
  {
    $champ_email = obtenirParametre('email');
    $champ_password = obtenirParametre('mot_passe');

    $user = $this->utilisateur->utilisateur_dans_BD($champ_email);

    if (!$user || empty($user)) {
      Session::set_flash('Utilisateur n\'existe pas', 'danger');
      redirect("/connexion_user");
      return;
    }

    $Verification_email = Validation::valider_champs('email', $champ_email, ['requis' => true, 'email' => true]);
    $Verification_password = Validation::valider_champs('mot de passe', $champ_password, ['requis' => true]);

    if ($Verification_email && $Verification_password) {
      $email = $user[0]['email'];
      $password = $user[0]['mot_de_passe_hash'];

      if (Validation::comparer_chaines($champ_email, $email) && password_verify($champ_password, $password)) {
        Session::set('id_utilisateur', [
          'id' => $user[0]['id'],
          'nom_utilisateur' => $user[0]['nom_utilisateur'],
          'email' => $user[0]['email'],
          'nom' => $user[0]['nom'],
          'prenom' => $user[0]['prenom']
        ]);

        require_once get_chemin_defaut('models/Annonce.php');
        $annonce = new Annonce();
        $utilisateur_id = Session::obtenir_id_utilisateur();
        $annonces = $annonce->get_annonces_par_utilisateur($utilisateur_id);

        Session::set_flash('Connexion réussie!', 'success');
        chargerVue("annonces/index", ["annonces" => $annonces]);
      } else {
        Session::set_flash('Email ou mot de passe invalide', 'danger');
        redirect('/connexion_user');
      }
    }
  }

  /**
   * Déconnecte l’utilisateur s’il est connecté, détruit la session et redirige vers l’accueil.
   *
   * @return void
   */
  public function deconnexion_utilisteur()
  {
    if (Session::est_connecte()) {
      Session::detruire();
      Session::demarrer(); // Redémarre une session vide
      Session::set_flash('Déconnexion réussie', 'danger');
    }
    redirect("/");
  }
}
