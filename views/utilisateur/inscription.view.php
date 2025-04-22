<!-- À inclure : entête et navigation -->

<!-- Register Container -->
<div class="container">
  <div class="register-container">
    <div class="register-header">
      <i class="fas fa-user-plus"></i>
      <h2>Créer un compte</h2>
      <p class="text-muted">Rejoignez la communauté des collectionneurs pop culture</p>
    </div>

    <!-- À inclure : message d'erreurs -->

    <form class="register-form" method="POST" action="#">
      <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
          <input type="text" class="form-control" id="firstname" name="prenom" placeholder="Prénom" value="" required>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="lastname" name="nom" placeholder="Nom" value="" required>
        </div>
      </div>

      <div class="mb-3">
        <input type="text" class="form-control" id="username" name="nom_utilisateur" placeholder="Nom d'utilisateur" value="" required>
      </div>

      <div class="mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Adresse email" value="" required>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" id="password" name="mot_passe" placeholder="Mot de passe" required>
        <div class="password-requirements">
          <small>Le mot de passe doit contenir :</small>
          <ul>
            <li>Au moins 8 caractères</li>
            <li>Au moins une lettre majuscule</li>
            <li>Au moins un chiffre</li>
            <li>Au moins un caractère spécial</li>
          </ul>
        </div>
      </div>

      <div class="mb-4">
        <input type="password" class="form-control" id="confirm-password" name="confirmation_mot_passe" placeholder="Confirmer le mot de passe" required>
      </div>

      <div class="mb-4 form-check">
        <input class="form-check-input" type="checkbox" id="termsCheck" required>
        <label class="form-check-label" for="termsCheck">
          J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> et la <a href="#" class="text-decoration-none">politique de confidentialité</a>
        </label>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-4">S'inscrire</button>

      <div class="text-center mb-3">
        <span>Déjà inscrit? </span>
        <a href="#" class="text-decoration-none">Se connecter</a>
      </div>

      <div class="divider">
        <span>OU S'INSCRIRE AVEC</span>
      </div>

      <div class="social-login">
        <button type="button" class="btn btn-facebook mb-2">
          <i class="fab fa-facebook-f"></i> Facebook
        </button>
        <button type="button" class="btn btn-google">
          <i class="fab fa-google"></i> Google
        </button>
      </div>
    </form>
  </div>
</div>

<!-- À inclure : pied de page -->