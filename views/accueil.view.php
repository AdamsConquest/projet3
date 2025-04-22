<!-- À inclure : entête et navigation -->

<!-- Hero Section -->
<section class="hero-section">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Bienvenue sur PopBazaar</h1>
    <p class="lead">Le marché des objets de culture pop</p>
    <div class="mt-4">
      <a href="#" class="btn btn-secondary btn-lg me-2">
        <i class="fas fa-plus-circle me-2"></i>Déposer une annonce
      </a>
      <a href="#categories" class="btn btn-outline-light btn-lg">
        <i class="fas fa-search me-2"></i>Explorer les catégories
      </a>
    </div>
  </div>
</section>

<!-- Main Content -->
<div class="container">
  <!-- Categories Section -->
  <section id="categories" class="mb-5">
    <h2 class="text-center mb-4">Catégories populaires</h2>
    <div class="row g-4">
      <!-- Répéter pour chaque catégorie -->
      <div class="col-md-3">
        <div class="category-card">
          <div class="category-icon">
            <i class="fas fa-gamepad"></i>
          </div>
          <h4>Jeux vidéo</h4>
          <p>Consoles, jeux, accessoires et goodies</p>
          <a href="#" class="btn btn-sm btn-primary">Explorer</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <div class="category-icon">
            <i class="fas fa-mask"></i>
          </div>
          <h4>Super-héros</h4>
          <p>Figurines, comics et objets de collection</p>
          <a href="#" class="btn btn-sm btn-primary">Explorer</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <div class="category-icon">
            <i class="fas fa-film"></i>
          </div>
          <h4>Films cultes</h4>
          <p>DVDs, affiches et produits dérivés</p>
          <a href="#" class="btn btn-sm btn-primary">Explorer</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="category-card">
          <div class="category-icon">
            <i class="fas fa-tv"></i>
          </div>
          <h4>Séries TV</h4>
          <p>Coffrets, vêtements et accessoires</p>
          <a href="#" class="btn btn-sm btn-primary">Explorer</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Listings -->
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Annonces en vedette</h2>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Trier par
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Plus récent</a></li>
          <li><a class="dropdown-item" href="#">Prix croissant</a></li>
          <li><a class="dropdown-item" href="#">Prix décroissant</a></li>
        </ul>
      </div>
    </div>
    
    <div class="row">
      <!-- Répéter pour chaque annonce -->
      <div class="col-md-4 col-lg-3">
        <div class="card h-100">
          <div class="favorite-icon">
            <i class="fas fa-heart"></i>
          </div>
          <span class="badge bg-primary category-badge">Jeux vidéo</span>
          <img src="/assets/images/placeholders/300x200.png" class="card-img-top" alt="Nintendo Switch">
          <div class="card-body">
            <h5 class="card-title">Nintendo Switch + Zelda BOTW</h5>
            <div class="mb-2">
              <span class="price-tag">125 €</span>
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
      <!-- Fin de la répétition -->
    </div>
    
    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Suivant</a>
        </li>
      </ul>
    </nav>
  </section>
</div>

<!-- À inclure : pied de page -->