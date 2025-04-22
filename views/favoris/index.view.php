<!-- À inclure : entête et navigation -->

<!-- Main Content -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Accueil</a></li>
      <li class="breadcrumb-item active">Mes favoris</li>
    </ol>
  </nav>

  <div class="section-header">
    <h2><i class="fas fa-heart me-2" style="color: red;"></i>Mes annonces favorites</h2>
  </div>

  <!-- Favorites List -->
  <div class="row">
    <!-- Favorite Item 1 -->
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <div class="favorite-icon active" onclick="toggleFavorite(this)">
          <i class="fas fa-heart"></i>
        </div>
        <span class="badge bg-warning category-badge">Films cultes</span>
        <img src="/assets/images/placeholders/300x200.png" class="card-img-top" alt="Poster Star Wars">
        <div class="card-body">
          <h5 class="card-title">Poster original Star Wars 1977</h5>
          <div class="mb-2">
            <span class="price-tag">75 $</span>
            <span class="badge bg-secondary ms-2">Bon état</span>
          </div>
          <p class="card-text">Affiche originale de Star Wars Un Nouvel Espoir de 1977. Format 60x90cm, quelques traces d'usure.</p>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <small class="text-muted">Publié il y a 1 semaine</small>
          <a href="#" class="btn btn-sm btn-primary">Voir détails</a>
        </div>
      </div>
    </div>

    <!-- Favorite Item 2 -->
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <div class="favorite-icon active" onclick="toggleFavorite(this)">
          <i class="fas fa-heart"></i>
        </div>
        <span class="badge bg-danger category-badge">Séries TV</span>
        <img src="/assets/images/placeholders/300x200.png" class="card-img-top" alt="Game of Thrones">
        <div class="card-body">
          <h5 class="card-title">Épée Longclaw Game of Thrones</h5>
          <div class="mb-2">
            <span class="price-tag">150 $</span>
            <span class="badge bg-success ms-2">Neuf</span>
          </div>
          <p class="card-text">Réplique officielle de l'épée Longclaw de Jon Snow, édition collector avec support mural.</p>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <small class="text-muted">Publié il y a 2 jours</small>
          <a href="#" class="btn btn-sm btn-primary">Voir détails</a>
        </div>
      </div>
    </div>

    <!-- Favorite Item 3 -->
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <div class="favorite-icon active" onclick="toggleFavorite(this)">
          <i class="fas fa-heart"></i>
        </div>
        <span class="badge bg-primary category-badge">Jeux vidéo</span>
        <img src="/assets/images/placeholders/300x200.png" class="card-img-top" alt="Nintendo Switch">
        <div class="card-body">
          <h5 class="card-title">Nintendo Switch + Zelda BOTW</h5>
          <div class="mb-2">
            <span class="price-tag">125 $</span>
            <span class="badge bg-success ms-2">Comme neuf</span>
          </div>
          <p class="card-text">Console Nintendo Switch avec jeu Zelda Breath of the Wild inclus. Très bon état, peu utilisée.</p>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <small class="text-muted">Publié il y a 2 jours</small>
          <a href="#" class="btn btn-sm btn-primary">Voir détails</a>
        </div>
      </div>
    </div>

    <!-- Favorite Item 4 -->
    <div class="col-md-4 col-lg-3">
      <div class="card h-100">
        <div class="favorite-icon active" onclick="toggleFavorite(this)">
          <i class="fas fa-heart"></i>
        </div>
        <span class="badge bg-info category-badge">Super-héros</span>
        <img src="/assets/images/placeholders/300x200.png" class="card-img-top" alt="Casque Iron Man">
        <div class="card-body">
          <h5 class="card-title">Casque Iron Man échelle 1:1</h5>
          <div class="mb-2">
            <span class="price-tag">200 $</span>
            <span class="badge bg-success ms-2">Neuf</span>
          </div>
          <p class="card-text">Réplique officielle du casque d'Iron Man Mark III, échelle 1:1, avec effets lumineux.</p>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <small class="text-muted">Publié il y a 4 jours</small>
          <a href="#" class="btn btn-sm btn-primary">Voir détails</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Example of Empty Favorites State -->
  <div class="empty-favorites" style="display: none;">
    <i class="far fa-heart"></i>
    <h3>Aucune annonce en favoris</h3>
    <p class="text-muted mb-4">Vous n'avez pas encore ajouté d'annonces à vos favoris.</p>
    <a href="#" class="btn btn-primary">
      <i class="fas fa-search me-2"></i>Parcourir les annonces
    </a>
  </div>

  <!-- Pagination -->
  <nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Suivant</a>
      </li>
    </ul>
  </nav>
</div>

<!-- À inclure : pied de page -->