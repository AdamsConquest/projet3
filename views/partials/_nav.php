<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <i class="fas fa-store-alt me-2"></i>
      PopBazaar
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Accueil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Catégories
          </a>
          <ul class="dropdown-menu">
            <!-- À générer dynamiquement ultérieurement -->
            <li><a class="dropdown-item" href="#">Jeux vidéo</a></li>
            <li><a class="dropdown-item" href="#">Super-héros</a></li>
            <li><a class="dropdown-item" href="#">Films cultes</a></li>
            <li><a class="dropdown-item" href="#">Séries TV</a></li>
          </ul>
        </li>
        <!-- Si l'utilisateur est connecté : -->
        <li class="nav-item">
          <a class="nav-link" href="#">Mes favoris</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Mes annonces</a>
        </li>
        <!-- Fin condition -->
      </ul>
      <form class="d-flex me-2">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="Rechercher..." aria-label="Search">
          <button class="btn btn-light" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
      <!-- Si l'utilisateur est connecté : -->
      <div class="d-flex align-items-center">
        <div class="dropdown">
          <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
            <img src="/assets/images/placeholders/40x40.png" class="rounded-circle me-2" alt="Avatar" style="width: 32px; height: 32px; object-fit: cover;">
            <span><!-- Nom d'utilisateur à afficher --></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Mon profil</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-heart me-2"></i> Mes favoris</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-tag me-2"></i> Mes annonces</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="#" class="d-inline">
                <button type="submit" class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <!-- Sinon (utilisateur non connecté) : -->
      <div class="d-flex align-items-center">
        <a href="#" class="btn btn-dark me-2">Se connecter</a>
        <a href="#" class="btn btn-dark">S'inscrire</a>
      </div>
      <!-- Fin condition -->
    </div>
  </div>
</nav>