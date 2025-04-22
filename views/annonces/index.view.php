<!-- Inclure l'entête ici -->
<!-- Inclure la navigation ici -->

<!-- Main Content -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item active"><!-- Afficher le titre ici --></li>
        </ol>
    </nav>

    <div class="section-header">
        <h2><i class="fas fa-bullhorn me-2"></i><!-- Afficher le titre ici --></h2>
    </div>


    <!-- Action Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ul class="nav nav-pills tab-pills">
            <li class="nav-item">
                <a class="nav-link <!-- Afficher "active" si aucune sélection n'est faite -->" href="/annonces">Toutes (<!-- Afficher le nombre total d'annonces -->)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <!-- Afficher "active" si la sélection est "actives" -->" href="/annonces?selection=actives">Actives (<!-- Afficher le nombre d'annonces actives -->)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <!-- Afficher "active" si la sélection est "vendues" -->" href="/annonces?selection=vendues">Vendues (<!-- Afficher le nombre d'annonces vendues -->)</a>
            </li>
        </ul>

        <a href="/annonces/ajouter" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Créer une annonce
        </a>
    </div>
    <div class="row">
        <!-- Boucle pour afficher toutes les annonces -->
        <!-- Pour chaque annonce -->

            <!-- Listings -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="listing-status">
                        <span class="badge bg-success"><!-- Afficher "Active" ou "Inactive" selon l'état de l'annonce --></span>
                    </div>
                    <div class="listing-actions">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/annonces/<!-- ID du produit -->"><i class="fas fa-eye me-2"></i>Voir</a></li>
                                <li><a class="dropdown-item" href="/annonces/<!-- ID du produit -->/modifier"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                <li>

                                    <!-- Formulaire pour marquer comme vendu -->
                                    <form id="form-vendue" method="POST" action="/annonces/<!-- ID du produit -->">
                                        <input type="hidden" name="est_vendu" value="1">
                                        <button class="dropdown-item text-danger" type="submit"><i class="fas fa-check-circle me-2"></i>Marquer comme vendu</button>
                                    </form>


                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>

                                    <form method="POST" action="/annonces/<!-- ID du produit -->/supprimer">
                                        <button class="dropdown-item text-danger" type="submit"><i class="fas fa-trash-alt me-2"></i>Supprimer</button>
                                    </form>
                            </ul>
                        </div>
                    </div>
                    <img src="/images/300x200.png" class="card-img-top" alt="PS5">
                    <div class="card-body">
                        <h5 class="card-title"><!-- Afficher le titre de l'annonce --></h5>
                        <div class="mb-2">
                            <span class="price-tag"><!-- Afficher le prix de l'annonce --></span>
                            <span class="badge bg-primary ms-2"><!-- Afficher la catégorie de l'annonce --></span>
                            <span class="badge bg-secondary ms-2"><!-- Afficher l'état du produit --></span>
                            <!-- Si le produit est vendu -->
                                <span class="badge bg-danger text-light ms-2"><!-- Afficher "Vendu" si le produit est vendu --></span>
                            <!-- Fin si -->
                        </div>
                        <p class="card-text"><!-- Afficher la description de l'annonce --></p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Publiée <!-- Afficher le temps écoulé depuis la création --></small>
                            <span class="text-muted"><i class="fas fa-eye me-1"></i> <!-- Afficher le nombre de vues --></span>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Fin de la boucle -->
    </div>




    <!-- Empty Listings State (Hidden) -->
    <div class="empty-listings" style="display: none;">
        <i class="fas fa-tag"></i>
        <h3>Aucune annonce publiée</h3>
        <p class="text-muted mb-4">Vous n'avez pas encore publié d'annonces.</p>
        <a href="/annonces/ajouter" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Créer ma première annonce
        </a>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">

            <!-- Lien vers la page précédente -->
            <li class="page-item <!-- Afficher "disabled" si c'est la première page -->">
                <a class="page-link" href="?page=<!-- Numéro de page - 1 --><!-- Ajouter le paramètre de sélection si présent -->" tabindex="-1" aria-disabled="<!-- true si première page, sinon false -->">Précédent</a>
            </li>

            <!-- Liens pour chaque page -->
            <!-- Boucle pour chaque page -->
                <li class="page-item <!-- Afficher "active" si c'est la page courante -->">
                    <a class="page-link" href="?page=<!-- Numéro de page --><!-- Ajouter le paramètre de sélection si présent -->"><!-- Numéro de page --></a>
                </li>
            <!-- Fin de la boucle -->

            <!-- Lien vers la page suivante -->
            <li class="page-item <!-- Afficher "disabled" si c'est la dernière page -->">
                <a class="page-link" href="?page=<!-- Numéro de page + 1 --><!-- Ajouter le paramètre de sélection si présent -->" aria-disabled="<!-- true si dernière page, sinon false -->">Suivant</a>
            </li>

        </ul>
    </nav>

</div>

<script>
    const activerSelection = (element) => {
        const liens = document.querySelectorAll('.nav-link');
        liens.forEach(lien => {
            lien.classList.remove('active');
        });
        element.classList.add('active');
    }
</script>

<!-- Inclure le pied de page ici -->