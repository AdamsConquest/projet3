<!-- À inclure : entête et navigation -->

<!-- Main Content -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Accueil</a></li>
      <li class="breadcrumb-item active">Mon profil</li>
    </ol>
  </nav>

  <div class="section-header">
    <h2><i class="fas fa-user-circle me-2"></i>Mon profil</h2>
  </div>

  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-4 mb-4">
      <!-- Profile Card -->
      <div class="product-details text-center mb-4">
        <div class="position-relative d-inline-block mb-4">
          <img src="/assets/images/placeholders/200x200.png" alt="Photo de profil" class="rounded-circle img-thumbnail" style="width: 180px; height: 180px; object-fit: cover;">
          <button class="btn btn-sm btn-light rounded-circle position-absolute bottom-0 end-0" style="box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Changer de photo">
            <i class="fas fa-camera"></i>
          </button>
        </div>
        <h3 class="mb-1"><!-- Nom d'utilisateur à afficher --></h3>
        <p class="text-muted mb-3"><!-- Date d'inscription à afficher --></p>
        <div class="mb-3">
          <div class="rating-stars mb-1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <span class="ms-1">4.5/5</span>
          </div>
          <small class="text-muted">Basé sur 28 évaluations</small>
        </div>
        <div class="d-grid gap-2">
          <button class="btn btn-outline-primary">
            <i class="fas fa-eye me-2"></i>Voir mon profil public
          </button>
        </div>
      </div>

      <!-- Profile Menu -->
      <div class="list-group">
        <a href="#profile-info" class="list-group-item list-group-item-action active" data-bs-toggle="list">
          <i class="fas fa-user me-2"></i>Informations personnelles
        </a>
        <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="list">
          <i class="fas fa-lock me-2"></i>Sécurité
        </a>
        <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
          <i class="fas fa-bell me-2"></i>Notifications
        </a>
        <a href="#reviews" class="list-group-item list-group-item-action" data-bs-toggle="list">
          <i class="fas fa-star me-2"></i>Mes évaluations
        </a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-8">
      <div class="tab-content">
        <!-- Profile Information Section -->
        <div class="tab-pane fade show active" id="profile-info">
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3>Informations personnelles</h3>
              <button class="btn btn-sm btn-outline-primary" id="edit-profile-btn">
                <i class="fas fa-edit me-2"></i>Modifier
              </button>
            </div>

            <!-- View Mode -->
            <div id="profile-view">
              <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nom d'utilisateur:</div>
                <div class="col-md-8"><!-- Nom d'utilisateur à afficher --></div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nom complet:</div>
                <div class="col-md-8"><!-- Prénom et nom à afficher --></div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4 fw-bold">Email:</div>
                <div class="col-md-8"><!-- Email à afficher --></div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4 fw-bold">Bio:</div>
                <div class="col-md-8">Passionné de jeux vidéo et de culture pop. Collectionneur de figurines Nintendo et produits dérivés de cinéma.</div>
              </div>
            </div>

            <!-- Edit Mode (Hidden by default) -->
            <div id="profile-edit" style="display: none;">
              <form>
                <div class="mb-3">
                  <label for="username" class="form-label">Nom d'utilisateur</label>
                  <input type="text" class="form-control" id="username" value="LinkMaster64">
                </div>
                <div class="row mb-3">
                  <div class="col">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstname" value="Jean">
                  </div>
                  <div class="col">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastname" value="Dupont">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" value="jean.dupont@example.com">
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Téléphone</label>
                  <input type="tel" class="form-control" id="phone" value="06 12 34 56 78">
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Adresse</label>
                  <input type="text" class="form-control" id="address" value="123 Rue de la République, 75001 Paris">
                </div>
                <div class="mb-3">
                  <label for="bio" class="form-label">Bio</label>
                  <textarea class="form-control" id="bio" rows="3">Passionné de jeux vidéo et de culture pop. Collectionneur de figurines Nintendo et produits dérivés de cinéma.</textarea>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-outline-secondary me-2" id="cancel-edit-btn">Annuler</button>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Security Section -->
        <div class="tab-pane fade" id="security">
          <div class="product-details">
            <h3 class="mb-4">Sécurité</h3>

            <div class="mb-4">
              <h5>Changer le mot de passe</h5>
              <form>
                <div class="mb-3">
                  <label for="current-password" class="form-label">Mot de passe actuel</label>
                  <input type="password" class="form-control" id="current-password">
                </div>
                <div class="mb-3">
                  <label for="new-password" class="form-label">Nouveau mot de passe</label>
                  <input type="password" class="form-control" id="new-password">
                </div>
                <div class="mb-3">
                  <label for="confirm-password" class="form-label">Confirmer le nouveau mot de passe</label>
                  <input type="password" class="form-control" id="confirm-password">
                </div>
                <div class="password-requirements mb-3">
                  <small>Le mot de passe doit contenir :</small>
                  <ul>
                    <li>Au moins 8 caractères</li>
                    <li>Au moins une lettre majuscule</li>
                    <li>Au moins un chiffre</li>
                    <li>Au moins un caractère spécial</li>
                  </ul>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
              </form>
            </div>

            <hr>

            <div class="mb-4">
              <h5>Authentification à deux facteurs</h5>
              <p class="text-muted">L'authentification à deux facteurs ajoute une couche de sécurité supplémentaire à votre compte.</p>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="two-factor">
                <label class="form-check-label" for="two-factor">Activer l'authentification à deux facteurs</label>
              </div>
            </div>

            <hr>

            <div>
              <h5 class="text-danger">Supprimer le compte</h5>
              <p class="text-muted">Une fois que vous supprimez votre compte, il n'y a pas de retour en arrière. Soyez certain.</p>
              <button class="btn btn-outline-danger">Supprimer mon compte</button>
            </div>
          </div>
        </div>

        <!-- Notifications Section -->
        <div class="tab-pane fade" id="notifications">
          <div class="product-details">
            <h3 class="mb-4">Préférences de notifications</h3>

            <div class="mb-4">
              <h5>Notifications par email</h5>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="email-messages" checked>
                <label class="form-check-label" for="email-messages">
                  Nouveaux messages
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="email-favorites" checked>
                <label class="form-check-label" for="email-favorites">
                  Mise à jour des annonces favorites
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="email-listings">
                <label class="form-check-label" for="email-listings">
                  Activité sur mes annonces
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="email-news" checked>
                <label class="form-check-label" for="email-news">
                  Actualités et promotions
                </label>
              </div>
            </div>

            <hr>

            <div>
              <h5>Notifications push</h5>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="push-messages" checked>
                <label class="form-check-label" for="push-messages">
                  Nouveaux messages
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="push-favorites">
                <label class="form-check-label" for="push-favorites">
                  Mise à jour des annonces favorites
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="push-listings" checked>
                <label class="form-check-label" for="push-listings">
                  Activité sur mes annonces
                </label>
              </div>
            </div>

            <div class="mt-4">
              <button type="button" class="btn btn-primary">Enregistrer les préférences</button>
            </div>
          </div>
        </div>

        <!-- Reviews Section -->
        <div class="tab-pane fade" id="reviews">
          <div class="product-details">
            <h3 class="mb-4">Mes évaluations</h3>

            <ul class="nav nav-tabs mb-4">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#received-reviews">Reçues (28)</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#given-reviews">Données (15)</a>
              </li>
            </ul>

            <div class="tab-content">
              <!-- Received Reviews -->
              <div class="tab-pane fade show active" id="received-reviews">
                <!-- Review 1 -->
                <div class="review-item">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/assets/images/placeholders/100x100.png" alt="Avatar" class="user-avatar me-3">
                    <div>
                      <h6 class="mb-0">MarioFan75</h6>
                      <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <small class="text-muted">Il y a 2 semaines</small>
                    </div>
                  </div>
                  <p>Vendeur sérieux et réactif. La console était exactement comme décrite, bien emballée et envoyée rapidement. Je recommande !</p>
                  <div class="d-flex justify-content-end">
                    <small class="text-muted">Pour l'annonce: Nintendo Switch + Zelda BOTW</small>
                  </div>
                </div>

                <!-- Review 2 -->
                <div class="review-item">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/assets/images/placeholders/100x100.png" alt="Avatar" class="user-avatar me-3">
                    <div>
                      <h6 class="mb-0">GamerPro99</h6>
                      <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <small class="text-muted">Il y a 1 mois</small>
                    </div>
                  </div>
                  <p>Très bonne transaction. La PS5 fonctionne parfaitement bien. Vendeur à recommander sans hésitation.</p>
                  <div class="d-flex justify-content-end">
                    <small class="text-muted">Pour l'annonce: PS5 Edition Standard</small>
                  </div>
                </div>

                <!-- Review 3 -->
                <div class="review-item">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/assets/images/placeholders/100x100.png" alt="Avatar" class="user-avatar me-3">
                    <div>
                      <h6 class="mb-0">ZeldaFan123</h6>
                      <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                      </div>
                      <small class="text-muted">Il y a 2 mois</small>
                    </div>
                  </div>
                  <p>Excellente transaction ! La figurine est comme décrite, sans aucun défaut. Le vendeur a même inclus un support en bonus. Communication parfaite.</p>
                  <div class="d-flex justify-content-end">
                    <small class="text-muted">Pour l'annonce: Figurine Spider-Man Hot Toys</small>
                  </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination des avis" class="mt-4">
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
              </div>

              <!-- Given Reviews -->
              <div class="tab-pane fade" id="given-reviews">
                <!-- Review 1 -->
                <div class="review-item">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/assets/images/placeholders/100x100.png" alt="Avatar" class="user-avatar me-3">
                    <div>
                      <h6 class="mb-0">BatmanCollector</h6>
                      <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <small class="text-muted">Il y a 3 semaines</small>
                    </div>
                  </div>
                  <p>Super vendeur ! Transaction rapide et comics en parfait état. Je recommande vivement.</p>
                  <div class="d-flex justify-content-end">
                    <small class="text-muted">Pour l'annonce: Collection Comics Batman</small>
                  </div>
                </div>

                <!-- Review 2 -->
                <div class="review-item">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/assets/images/placeholders/100x100.png" alt="Avatar" class="user-avatar me-3">
                    <div>
                      <h6 class="mb-0">StarWarsLover</h6>
                      <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      <small class="text-muted">Il y a 1 mois</small>
                    </div>
                  </div>
                  <p>Bons posters, bien protégés pour l'expédition. Un petit délai dans l'envoi mais bonne communication. Satisfait de l'achat.</p>
                  <div class="d-flex justify-content-end">
                    <small class="text-muted">Pour l'annonce: Posters Star Wars original</small>
                  </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination des avis" class="mt-4">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- À inclure : pied de page -->