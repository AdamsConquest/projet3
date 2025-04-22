<!-- Inclure la vue partielle _entete ici -->
<!-- Inclure la vue partielle _nav ici -->

<!-- Main Content -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Accueil</a></li>
      <li class="breadcrumb-item"><a href="/annonces">Mes annonces</a></li>
      <li class="breadcrumb-item active">Modifier une annonce</li>
    </ol>
  </nav>

  <div class="create-listing-container">
    <h1 class="form-title"><i class="fas fa-edit me-2"></i>Modifier votre annonce</h1>
    <p class="text-muted mb-4">Mettez à jour les informations de votre annonce pour la communauté PopBazaar.</p>

    <form method="POST" action="/annonces/<!-- ID de l'annonce -->">
      <!-- Catégorie Section -->
      <div class="form-section">
        <h3 class="form-section-title">
          <i class="fas fa-folder"></i>
          Catégorie
        </h3>
        <p class="text-muted mb-3">Sélectionnez la catégorie qui correspond le mieux à votre produit</p>

        <input type="hidden" id="categorie" name="categorie" value="<!-- Nom de la catégorie -->">

        <div class="row g-3">
          <!-- Cartes de catégorie -->
          <!-- Même structure conservée -->
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
          <input type="text" class="form-control" id="title" value="<!-- titre -->" name="titre" required>
          <div class="form-text">Soyez précis et concis (max. 70 caractères)</div>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" rows="5" name="description" required><!-- description --></textarea>
          <div class="form-text">Minimum 30 caractères, évitez d'inclure vos coordonnées personnelles</div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="prix" class="form-label">Prix ($) <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01" value="<!-- prix -->" required>
              <span class="input-group-text">$</span>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">État du produit <span class="text-danger">*</span></label>
            <input type="hidden" id="etat" name="etat" value="<!-- etat -->">
            <div>
              <!-- Boutons d’état -->
            </div>
          </div>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="active" name="est_actif" <!-- coché si actif -->>
          <label class="form-check-label" for="active">
            Annonce active
          </label>
          <div class="form-text">Décochez cette option pour masquer temporairement votre annonce</div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <div>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="fas fa-trash-alt me-2"></i>Supprimer
          </button>
          <button type="button" class="btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#soldModal">
            <i class="fas fa-check-circle me-2"></i>Marquer comme vendu
          </button>
        </div>
        <div>
          <a href="/annonces" class="btn btn-outline-secondary me-2">
            <i class="fas fa-times me-2"></i>Annuler
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Enregistrer les modifications
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Formulaires cachés pour suppression et vente -->
<form id="form-supprimer" method="POST" action="/annonces/<!-- ID -->/supprimer" style="display:none;"></form>
<form id="form-vendue" method="POST" action="/annonces/<!-- ID -->" style="display:none;">
  <input type="hidden" name="est_vendu" value="1">
</form>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Êtes-vous sûr de vouloir supprimer cette annonce ? Cette action est irréversible.</p>
        <p class="fw-bold"><!-- Titre de l'annonce --></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" onclick="document.getElementById('form-supprimer').submit()">Confirmer la suppression</button>
      </div>
    </div>
  </div>
</div>

<!-- Sold Modal -->
<div class="modal fade" id="soldModal" tabindex="-1" aria-labelledby="soldModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="soldModalLabel">Marquer comme vendu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Félicitations pour votre vente ! Voulez-vous marquer cette annonce comme vendue ?</p>
        <p class="fw-bold"><!-- Titre de l'annonce --></p>
        <p class="text-muted">L'annonce sera conservée dans votre historique mais ne sera plus visible par les autres utilisateurs.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" onclick="document.getElementById('form-vendue').submit()">Confirmer la vente</button>
      </div>
    </div>
  </div>
</div>

<script>
  function onDocumentLoaded() {
    document.querySelectorAll('.category-card').forEach(card => card.classList.remove('selected'));
    document.querySelectorAll('.condition-btn').forEach(btn => btn.classList.remove('selected'));

    const selectedCategory = document.getElementById('categorie').value;
    document.querySelectorAll('.category-card').forEach(card => {
      if (card.querySelector('h5').textContent === selectedCategory) {
        card.classList.add('selected');
      }
    });

    const selectedCondition = document.getElementById('etat').value;
    document.querySelectorAll('.condition-btn').forEach(btn => {
      if (btn.textContent.trim() === selectedCondition) {
        btn.classList.add('selected');
      }
    });
  }

  document.addEventListener("DOMContentLoaded", onDocumentLoaded);

  function selectCategory(element) {
    document.querySelectorAll('.category-card').forEach(card => card.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('categorie').value = element.querySelector('h5').innerText;
  }

  function selectCondition(element) {
    document.querySelectorAll('.condition-btn').forEach(btn => btn.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('etat').value = element.innerText;
  }

  document.querySelectorAll('.remove-image').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      const preview = this.closest('.image-preview');
      preview.remove();
    });
  });
</script>

<!-- Inclure la vue partielle _pied_page ici -->
