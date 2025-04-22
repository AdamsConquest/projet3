<!-- Inclure l'entête ici -->
<!-- Inclure la navigation ici -->

<!-- Main Content -->
<div class="container">
  <nav aria-label="breadcrumb" class="mt-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Accueil</a></li>
      <li class="breadcrumb-item"><a href="/annonces/">Mes annonces</a></li>
      <li class="breadcrumb-item active">Créer une annonce</li>
    </ol>
  </nav>

  <div class="create-listing-container">
    <h1 class="form-title"><i class="fas fa-plus-circle me-2"></i>Créer une nouvelle annonce</h1>
    <p class="text-muted mb-4">Remplissez tous les champs ci-dessous pour publier votre annonce dans la communauté PopBazar.</p>

    <form method="POST" action="/annonces">

      <input type="hidden" id="categorie" name="categorie" value="Jeux vidéo">


      <!-- Catégorie Section -->
      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-folder"></i>
          Catégorie
        </h3>
        <p class="text-muted mb-3">Sélectionnez la catégorie qui correspond le mieux à votre produit</p>

        <div class="row g-3">
          <div class="col-md-3">
            <div class="category-card selected" onclick="selectCategory(this)">
              <i class="fas fa-gamepad"></i>
              <h5>Jeux vidéo</h5>
              <p class="mb-0 small text-muted">Consoles, jeux, accessoires</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="category-card" onclick="selectCategory(this)">
              <i class="fas fa-mask"></i>
              <h5>Super-héros</h5>
              <p class="mb-0 small text-muted">Figurines, comics, costumes</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="category-card" onclick="selectCategory(this)">
              <i class="fas fa-film"></i>
              <h5>Films cultes</h5>
              <p class="mb-0 small text-muted">DVDs, affiches, objets</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="category-card" onclick="selectCategory(this)">
              <i class="fas fa-tv"></i>
              <h5>Séries TV</h5>
              <p class="mb-0 small text-muted">Coffrets, produits dérivés</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Informations Section -->
      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-info-circle"></i>
          Informations sur le produit
        </h3>

        <div class="mb-3">
          <label for="title" class="form-label">Titre de l'annonce <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="titre" name="titre" placeholder="Ex: Nintendo Switch + Zelda BOTW" required>
          <div class="form-text">Soyez précis et concis (max. 70 caractères)</div>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description" rows="5" placeholder="Décrivez votre produit en détail (état, caractéristiques, accessoires inclus...)" required></textarea>
          <div class="form-text">Minimum 30 caractères, évitez d'inclure vos coordonnées personnelles</div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="price" class="form-label">Prix ($) <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01" placeholder="Ex: 125" required>
              <span class="input-group-text">$</span>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">État du produit <span class="text-danger">*</span></label>
            <input type="hidden" id="etat" name="etat" value="Neuf">
            <div>
              <button type="button" class="condition-btn selected" onclick="selectCondition(this)">Neuf</button>
              <button type="button" class="condition-btn" onclick="selectCondition(this)">Comme neuf</button>
              <button type="button" class="condition-btn" onclick="selectCondition(this)">Très bon état</button>
              <button type="button" class="condition-btn" onclick="selectCondition(this)">Bon état</button>
              <button type="button" class="condition-btn" onclick="selectCondition(this)">État moyen</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-paper-plane me-2"></i>Publier l'annonce
        </button>
      </div>
    </form>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function selectCategory(element) {
    // Remove the 'selected' class from all category cards
    document.querySelectorAll('.category-card').forEach(card => {
      card.classList.remove('selected');
    });

    // Add the 'selected' class to the clicked card
    element.classList.add('selected');

    // modifer la valeur de l'input caché categorie
    $input = document.getElementById('categorie');
    $input.value = element.querySelector('h5').innerText;

  }

  function selectCondition(element) {
    // Remove the 'selected' class from all condition buttons
    document.querySelectorAll('.condition-btn').forEach(btn => {
      btn.classList.remove('selected');
    });

    // Add the 'selected' class to the clicked button
    element.classList.add('selected');

    // modifer la valeur de l'input caché etat
    $input = document.getElementById('etat');
    $input.value = element.innerText;
  }
</script>
<!-- Inclure le pied de page ici -->