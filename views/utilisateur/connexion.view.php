<!-- À inclure : entête et navigation -->

<!-- Login Container -->
<div class="container">
  <div class="login-container">
    <div class="login-header">
      <i class="fas fa-user-circle"></i>
      <h2>Connexion</h2>
      <p class="text-muted">Connectez-vous pour accéder à votre compte</p>
    </div>

    <!-- À inclure : message d'erreurs -->

    <form class="login-form" method="POST" action="#">
      <div class="mb-3">
        <input type="email" class="form-control" id="email" placeholder="Adresse email" name="email" required>
      </div>
      <div class="mb-4">
        <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="mot_passe" required>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
        </div>
        <a href="#" class="text-decoration-none">Mot de passe oublié?</a>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-4">Se connecter</button>

      <div class="text-center mb-3">
        <span>Pas encore de compte? </span>
        <a href="#" class="text-decoration-none">S'inscrire</a>
      </div>

      <div class="divider">
        <span>OU CONTINUER AVEC</span>
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