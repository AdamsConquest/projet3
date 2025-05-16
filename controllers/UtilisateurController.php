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
    $prenom = Validation::valider_champs('prénom', obtenirParametre('prenom'), ['requis' => true]);
    $nom = Validation::valider_champs('nom de famille', obtenirParametre('nom'), ['requis' => true]);
    $nom_utilisateur = Validation::valider_champs('nom d\'utilisateur', obtenirParametre('nom_utilisateur'), ['requis' => true]);

    $valeur_courriel = obtenirParametre('email');
    $courriel = Validation::valider_champs('email', $valeur_courriel, ['requis' => true]);

    $valeur_mdp = obtenirParametre('mot_passe');
    $regles_mdp = ['requis' => true, 'min' => 8, 'majuscule' => true, 'chiffre' => true, 'special' => true];
    $erreurs = [];

    foreach ($regles_mdp as $regle => $valeur) {
      $resultat = Validation::valider_champs('mot de passe', $valeur_mdp, [$regle => $valeur]);
      if ($resultat !== true) {
        $erreurs[] = $resultat;
      }
    }

    $mot_de_passe_confirmer = obtenirParametre('confirmation_mot_passe');

    if ($prenom === true && $nom === true && $nom_utilisateur === true && $courriel === true && empty($erreurs)) {
      if ($valeur_mdp === $mot_de_passe_confirmer) {
        $utilisateur_existant = $this->utilisateur->utilisateur_dans_BD($valeur_courriel);

        if (!empty($utilisateur_existant)) {

          Session::set_flash("Un compte avec ce courriel existe déjà.", "danger");
          chargerVue("utilisateur/inscription", donnees: [
            'prenom' => obtenirParametre('prenom'),
            'nom' => obtenirParametre('nom'),
            'email' => obtenirParametre('email'),
            'nom_utilisateur' => obtenirParametre('nom_utilisateur')
          ]);
          return;
        }
        $this->utilisateur->ajouter_Utilisateur(obtenirParametre('prenom'), obtenirParametre('nom'), obtenirParametre('nom_utilisateur'), $valeur_courriel, $valeur_mdp);

        $nouveau_utilisateur = $this->utilisateur->utilisateur_dans_BD($valeur_courriel);

        if ($nouveau_utilisateur) {
          Session::set('id_utilisateur', [
            'id' => $nouveau_utilisateur[0]['id'],
            'nom_utilisateur' => $nouveau_utilisateur[0]['nom_utilisateur'],
            'email' => $nouveau_utilisateur[0]['email'],
            'nom' => $nouveau_utilisateur[0]['nom'],
            'prenom' => $nouveau_utilisateur[0]['prenom']
          ]);
          Session::set_flash('Utilisateur créé avec succès.', 'success');
          redirect('/MesAnnonces');
        }
      } else {
        $erreurs[] = 'Les mots de passe ne correspondent pas.';
      }
    } else {
      foreach (['prenom' => $prenom, 'nom' => $nom, 'nom_utilisateur' => $nom_utilisateur, 'courriel' => $courriel] as $champ => $valeur) {
        if ($valeur !== true) {
          $erreurs[] = $valeur;
        }
      }
    }

    if (!empty($erreurs)) {
      Session::set_flash(implode('<br>', $erreurs), 'danger');
      chargerVue("utilisateur/inscription", donnees: [
        'prenom' => obtenirParametre('prenom'),
        'nom' => obtenirParametre('nom'),
        'email' => obtenirParametre('email'),
        'nom_utilisateur' => obtenirParametre('nom_utilisateur')
      ]);
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

    // Validate fields
    $Verification_email = Validation::valider_email($champ_email);
    $Verification_password = Validation::valider_champs('mot de passe', $champ_password, [
      'requis' => true
    ]);

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
      Session::demarrer();
      Session::set_flash('Déconmexion réussi', 'success');
      redirect("/");
    } else {
      redirect("/");
    }
  }
}
