<!-- Inclure l'entête ici -->
<!-- Inclure la navigation ici -->
<?php
chargerVuePartielle('_entete');
chargerVuePartielle('_nav');
?>

<!-- Main Content -->
<div class="container mt-4">
    <?php echo Session::afficher_flash() ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item active"></li>
        </ol>
    </nav>

    <div class="section-header">
        <h2><i class="fas fa-bullhorn me-2"></i></h2>
    </div>


    <!-- Action Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ul class="nav nav-pills tab-pills">
            <li class="nav-item">

                <a class="nav-link <!-- Afficher ' active' si aucune sélection n'est faite -->" href="/annonces">Toutes (<?php echo isset($annonces) ? obtenir_nbr_annonces($annonces)[0] : 0 ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <!-- Afficher ' active' si la sélection est 'actives' -->" href="/annonces?selection=actives">Actives (<?php echo isset($annonces) ? obtenir_nbr_annonces($annonces)[1] : 0 ?>)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <!-- Afficher ' active' si la sélection est 'vendues' -->" href="/annonces?selection=vendues">Vendues (<?php echo isset($annonces) ? obtenir_nbr_annonces($annonces)[2] : 0 ?>)</a>
            </li>
        </ul>

        <a href="/ajouter_annonce" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Créer une annonce
        </a>
    </div>
    <div class="row">
        <!-- Boucle pour afficher toutes les annonces -->
        <?php if (!isset($donnees["annonces"])) { ?>

            <!-- Empty Listings State (Hidden) -->
            <div class="empty-listings" style="display: none;">
                <i class="fas fa-tag"></i>
                <h3>Aucune annonce publiée</h3>
                <p class="text-muted mb-4">Vous n'avez pas encore publié d'annonces.</p>
                <a href="/annonces/ajouter" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Créer ma première annonce
                </a>
            </div>

            <?php } else {
            foreach ($donnees["annonces"] as $annonce) { ?>
                <!-- Pour chaque annonce -->
                <!-- Listings -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="listing-status">
                            <span class="badge bg-success"><?php echo $annonce['etat'] ?></span>
                        </div>
                        <div class="listing-actions">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/annonces/<?php echo $annonce['id'] ?>"><i class="fas fa-eye me-2"></i>Voir</a></li>
                                    <li><a class="dropdown-item" href="/annonces/<?php echo $annonce['id'] ?>/modifier"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                    <?php if ($_SERVER['REQUEST_URI'] === '/MesAnnonces') { ?>
                                        <li>

                                            <!-- Formulaire pour marquer comme vendu -->
                                            <form id="form-vendue" method="POST" action="/annonces/<?php echo $annonce['id'] ?>/est_vendu">
                                                <input type="hidden" name="est_vendu" value="1">
                                                <button class="dropdown-item text-danger" type="submit"><i class="fas fa-check-circle me-2"></i>Marquer comme vendu</button>
                                            </form>


                                        </li>
                                    <?php } ?>


                                    <?php if ($_SERVER['REQUEST_URI'] === '/MesAnnonces') { ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-id="<?php echo $annonce['id']; ?>"
                                                data-titre="<?php echo htmlspecialchars($annonce['titre']); ?>">
                                                <i class="fas fa-trash-alt me-2"></i>Supprimer
                                            </button>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <img src="/images/300x200.png" class="card-img-top" alt="PS5">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $annonce['titre'] ?></h5>
                            <div class="mb-2">
                                <span class="price-tag"><?php echo $annonce['prix'] ?></span>
                                <span class="badge bg-primary ms-2"><?php echo obtenir_nom_categorie($annonce['categorie_id']) ?></span>
                                <span class="badge bg-secondary ms-2"><?php echo $annonce['etat'] ?></span>
                                <!-- Si le produit est vendu -->
                                <?php if ($annonce['est_vendu'] == 0) { ?>
                                    <span class="badge bg-danger text-light ms-2"> Pas Vendu</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger text-light ms-2">Vendu</span>
                                <?php } ?>
                                <!-- Fin si -->
                            </div>
                            <p class="card-text"><?php echo $annonce['description'] ?></p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Publiée <?php echo il_y_a($annonce['date_creation']) ?></small>
                                <span class="text-muted"><i class="fas fa-eye me-1"></i> <?php echo $annonce['nombre_vues'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="form-supprimer" method="POST" action="/annonces/<?php echo $annonce['id'] ?>/supprimer" style="display:none;"></form>
            <?php } ?>
        <?php } ?>
        <!-- Fin de la boucle -->
    </div>



    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">

            <!-- Lien vers la page précédente -->
            <li class="page-item <!-- Afficher " disabled" si c'est la première page -->">
                <a class="page-link" href="?page=<!-- Numéro de page - 1 --><!-- Ajouter le paramètre de sélection si présent -->" tabindex="-1" aria-disabled="<!-- true si première page, sinon false -->">Précédent</a>
            </li>

            <!-- Liens pour chaque page -->
            <!-- Boucle pour chaque page -->
            <li class="page-item <!-- Afficher " active" si c'est la page courante -->">
                <a class="page-link" href="?page=<!-- Numéro de page --><!-- Ajouter le paramètre de sélection si présent -->"><!-- Numéro de page --></a>
            </li>
            <!-- Fin de la boucle -->

            <!-- Lien vers la page suivante -->
            <li class="page-item <!-- Afficher " disabled" si c'est la dernière page -->">
                <a class="page-link" href="?page=<!-- Numéro de page + 1 --><!-- Ajouter le paramètre de sélection si présent -->" aria-disabled="<!-- true si dernière page, sinon false -->">Suivant</a>
            </li>

        </ul>
    </nav>

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
                    <p class="fw-bold"><?php echo $annonce['titre'] ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('form-supprimer').submit()">Confirmer la suppression</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const activerSelection = (element) => {
        const liens = document.querySelectorAll('.nav-link');
        liens.forEach(lien => {
            lien.classList.remove('active');
        });
        element.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;


                const annonceId = button.getAttribute('data-id');
                const annonceTitre = button.getAttribute('data-titre');

                const modalTitle = deleteModal.querySelector('#modalAnnonceTitle');
                const deleteForm = deleteModal.querySelector('#deleteForm');

                modalTitle.textContent = annonceTitre;
                deleteForm.action = `/annonces/${annonceId}/supprimer`;
            });
        }
    });
</script>

<!-- Inclure le pied de page ici -->
<?php
chargerVuePartielle('_pied_page');
?>