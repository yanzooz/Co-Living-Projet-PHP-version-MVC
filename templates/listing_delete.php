<?php
require_once("block/header/dashboard_header.php");
?>

<div class="container my-5">
    <!-- .row + .justify-content-center pour centrer horizontalement le contenu -->
    <div class="row justify-content-center">
        <!-- .col-md-8 ou .col-lg-6 pour limiter la largeur sur les écrans moyens/grands -->
        <div class="col-md-8 col-lg-6">
            <!-- .text-center si vous voulez centrer TOUT le texte à l’intérieur de la carte -->
            <div class="card shadow p-4 text-center">
                <h2 class="text-danger mb-4">Confirmation de suppression</h2>

                <p class="mb-4">
                    Êtes-vous sûr de vouloir supprimer cette annonce&nbsp;?
                </p>

                <!-- Image de l'annonce -->
                <div class="mb-3">
                    <?php if (!empty($listing->getImage())): ?>
                        <img 
                            src="./images/<?= htmlspecialchars($listing->getImage()); ?>" 
                            alt="Image de l'annonce" 
                            class="img-fluid rounded" 
                            style="max-height: 300px; object-fit: cover;"
                        >
                    <?php else: ?>
                        <p class="text-muted">Aucune image disponible pour cette annonce.</p>
                    <?php endif; ?>
                </div>

                <!-- Informations sur l'annonce -->
                <h5 class="card-title">
                    <?= htmlspecialchars($listing->getTitle()); ?>
                </h5>
                <p>
                    <?= nl2br(htmlspecialchars($listing->getDescription())); ?>
                </p>
                <p class="text-muted">
                    Ajouté par&nbsp;: <?= htmlspecialchars($listing->getOwner()->getUsername()); ?>
                </p>

                <!-- Formulaire de confirmation -->
                <form method="POST" class="mt-4">
                    <!-- Boutons d'action, centrés grâce à .text-center ou .d-flex justify-content-center -->
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" class="btn btn-danger">
                            Confirmer la suppression
                        </button>
                        <a href="index.php?action=dashboard" class="btn btn-secondary">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("block/footer.php"); ?>
