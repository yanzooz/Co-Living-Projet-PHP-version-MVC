<!-- filepath: c:\wamp64\www\Projet4MVC\templates\admin_index_listing.php -->
<?php if($_SESSION["role"] === "admin"){
   require_once("block/header/admin_header.php");
}?>
<?php if($_SESSION["role"] === "invite"){
   require_once("block/header/guest_header.php");
}?>
<!-- MESSAGE D'ALERTE -->
<?php if (isset($_SESSION["message"])): ?>
    <div class="alert alert-danger d-flex align-items-center mt-4" role="alert">
        <?= htmlspecialchars($_SESSION["message"]); ?>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
    <?php unset($_SESSION["message"]); ?>
<?php endif; ?>

<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Nos Annonces</h2>
    <div class="row g-4">
        <?php foreach ($listings as $listing): ?>
            <div class="col-md-4">
                <a href="index.php?action=detailListing&id=<?= $listing->getId(); ?>" class="text-decoration-none text-dark">
                    <div class="position-relative">
                        <!-- Carrousel -->
                        <div id="carousel-<?= $listing->getId(); ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Première image (BDD) -->
                                <div class="carousel-item active">
                                    <img src="images/<?= $listing->getImage() ?:'Northern_Blvd_Party_Room.1494256942.jpeg'?>" class="d-block w-100 rounded" alt="Image principale">
                                </div>
                                <!-- Images statiques -->
                                <div class="carousel-item">
                                    <img src="images/Northern_Blvd_Party_Room.1494256942.jpeg" class="d-block w-100 rounded" alt="Image secondaire">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/Room_Prestige_4_-_CHotel_Regina_Paris-min.jpg.webp" class="d-block w-100 rounded" alt="Image tertiaire">
                                </div>
                            </div>
                            <!-- Contrôles précédent/suivant -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $listing->getId(); ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Précédent</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $listing->getId(); ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Suivant</span>
                            </button>
                        </div>

                        <!-- Bouton Ajouter en favoris -->
                        <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm favoris-btn">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                    <div class="mt-3 d-flex justify-content-between align-items-start">
                        <!-- Texte descriptif -->
                        <div>
                            <p class="mb-1 fw-bold">Paris, France</p>
                            <p class="text-muted mb-1"><?= htmlspecialchars($listing->getTitle()); ?></p>
                            <p class="fw-bold">120€ / nuit</p>
                        </div>
                        <!-- Note en étoiles -->
                        <div class="text-dark">
                            <i class="bi bi-star-fill"></i> 4.0
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once("block/footer.php");
?>