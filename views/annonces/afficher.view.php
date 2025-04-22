<!-- À inclure : entête et navigation -->

<!-- Main Content -->
<div class="container mt-3">
  <div class="row">
    <!-- Product Images -->
    <div class="col-lg-7 mb-4">
      <div class="mb-3">
        <img src="/images/700x500.png" alt="Titre de l'annonce" class="product-image" id="mainImage">
      </div>
      <div class="d-flex justify-content-center">
        <img src="/images/200x200.png" class="image-thumbnail me-2 active" onclick="changeImage(this)">
        <img src="/images/200x200.png" class="image-thumbnail me-2" onclick="changeImage(this)">
        <img src="/images/200x200.png" class="image-thumbnail" onclick="changeImage(this)">
      </div>
    </div>

    <!-- Product Information -->
    <div class="col-lg-5">
      <div class="product-details mb-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <h1 class="mb-0"><!-- Titre de l'annonce --></h1>
          <div class="favorite-btn active" id="favoriteBtn">
            <i class="fas fa-heart"></i>
          </div>
        </div>

        <div class="mb-3">
          <span class="badge bg-primary"><!-- Catégorie --></span>
          <span class="badge bg-success ms-2"><!-- État --></span>
          <span class="badge bg-secondary ms-2"><!-- Date de publication --></span>
        </div>

        <div class="mb-4">
          <span class="price-tag"><!-- Prix --> $</span>
        </div>

        <div class="mb-4">
          <h5>Description</h5>
          <p><!-- Description de l'annonce --></p>
        </div>
      </div>

      <!-- Seller Information -->
      <div class="seller-info">
        <h5>Informations sur le vendeur</h5>
        <div class="d-flex align-items-center mb-3">
          <img src="/images/100x100.png" alt="Avatar" class="user-avatar me-3">
          <div>
            <h6 class="mb-0"><!-- Nom du vendeur --></h6>
            <div class="rating-stars mb-1">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span class="ms-1">(4.5/5 - 28 avis)</span>
            </div>
            <small class="text-muted"><!-- Membre depuis --></small>
          </div>
        </div>
        <p class="mb-3">
          <i class="fas fa-envelope me-2"></i>
          <a href="mailto:contact@example.com"><!-- Email du vendeur --></a>
        </p>
        <a href="#" class="btn btn-primary w-100">
          <i class="fas fa-comment-alt me-2"></i>Contacter le vendeur
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to change main image when thumbnail is clicked
  function changeImage(element) {
    document.querySelectorAll('.image-thumbnail').forEach(thumbnail => {
      thumbnail.classList.remove('active');
    });
    element.classList.add('active');
    document.getElementById('mainImage').src = element.src;
  }

  // Toggle favorite button
  document.getElementById('favoriteBtn').addEventListener('click', function() {
    this.classList.toggle('active');
  });

  // Star rating functionality
  const ratingStars = document.querySelectorAll('.rating-input i');
  ratingStars.forEach((star, index) => {
    star.addEventListener('click', () => {
      ratingStars.forEach((s, idx) => {
        if (idx <= index) {
          s.classList.remove('far');
          s.classList.add('fas');
        } else {
          s.classList.remove('fas');
          s.classList.add('far');
        }
      });
    });
  });
</script>

<!-- À inclure : pied de page -->