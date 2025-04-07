<?php
require_once("block/header/header.php");
?>

<!-- ======================
     CSS CUSTOM
====================== -->
<style>
    /* Section pour t'aider à structurer ton style. 
       Mets ces classes dans un fichier .css si tu préfères
       et importe-le dans ton header. */

    /* Titre principal de l'annonce */
    .listing-title {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Sous-titre pour la localisation, etc. */
    .listing-subtitle {
        font-size: 1rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Boutons d'action à côté du titre (partager, favoris) */
    .action-buttons {
        display: flex;
        gap: 1rem;
    }

    .action-buttons button {
        background: none;
        border: none;
        color: #333;
        font-size: 1.2rem;
        transition: color 0.2s ease-in-out;
    }
    .action-buttons button:hover {
        color: #000;
    }

    /* Carrousel un peu arrondi et ombré */
    .carousel .carousel-item img {
        border-radius: 0.75rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Titres de sections (Description, Équipements, Avis) */
    .section-heading {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    /* Liste d'équipements */
    .amenity-list p {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Bloc Avis */
    .review {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #fafafa;
    }

    /* CTA (call-to-action) Réserver */
    .btn-cta {
        background-color: #000; /* noir */
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 1.25rem;
        border-radius: 0.5rem;
        transition: background 0.2s ease-in-out;
    }
    .btn-cta:hover {
        color: #fff;
        background-color: #333;
    }
</style>

<div class="container my-5">

    <!-- =======================
         EN-TÊTE DE L'ANNONCE
    ======================= -->
    <div class="row mb-4">
        <div class="col-12 col-md-8">
            <!-- Titre de l'annonce -->
            <h1 class="listing-title">
                <?= htmlspecialchars($listing->getTitle()); ?>
            </h1>
            <!-- Localisation & petites icônes -->
            <div class="listing-subtitle">
                <i class="bi bi-geo-alt-fill"></i>
                Paris, France
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-start justify-content-md-end mt-3 mt-md-0">
            <!-- Boutons d'action (Partager, Favoris) -->
            <div class="action-buttons">
                <button type="button">
                    <i class="bi bi-share-fill"></i> <!-- Partager -->
                </button>
                <button type="button">
                    <i class="bi bi-heart-fill"></i> <!-- Mettre en favoris -->
                </button>
            </div>
        </div>
    </div>

    <!-- =======================
         CARROUSEL D'IMAGES
    ======================= -->
    <div class="row">
        <div class="col-12">
            <div id="carouselDetail" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Première image dynamique -->
                    <div class="carousel-item active">
                        <img 
                            src="images/<?= $listing->getImage() ?: 'placeholder.jpg'; ?>" 
                            class="d-block w-100" 
                            alt="Image principale"
                        >
                    </div>
                    <!-- Exemples d’images additionnelles statiques -->
                    <div class="carousel-item">
                        <img 
                            src="images/Northern_Blvd_Party_Room.1494256942.jpeg" 
                            class="d-block w-100" 
                            alt="Image secondaire"
                        >
                    </div>
                    <div class="carousel-item">
                        <img 
                            src="images/Room_Prestige_4_-_CHotel_Regina_Paris-min.jpg.webp" 
                            class="d-block w-100" 
                            alt="Image tertiaire"
                        >
                    </div>
                </div>

                <!-- Contrôles précédent/suivant -->
                <button 
                    class="carousel-control-prev" 
                    type="button" 
                    data-bs-target="#carouselDetail" 
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button 
                    class="carousel-control-next" 
                    type="button" 
                    data-bs-target="#carouselDetail" 
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
            </div>
        </div>
    </div>

    <!-- =======================
         DESCRIPTION
    ======================= -->
    <div class="row mb-4">
        <div class="col-12 col-md-8">
            <h2 class="section-heading">Description</h2>
            <p class="lead">
                <?= nl2br(htmlspecialchars($listing->getDescription())); ?>
            </p>
        </div>
        <!-- CTA Réserver: on le met ici en colonne latérale (ou en bas sur mobile) -->
        <div class="col-12 col-md-4 d-flex align-items-start justify-content-md-end">
            <button class="btn btn-cta">Réserver</button>
        </div>
    </div>

    <!-- =======================
         ÉQUIPEMENTS
    ======================= -->
    <div class="mb-4">
        <h2 class="section-heading">Équipements</h2>
        <div class="row amenity-list">
            <div class="col-md-4">
                <p><i class="bi bi-wifi"></i> Wi-Fi gratuit</p>
                <p><i class="bi bi-tv"></i> Télévision</p>
            </div>
            <div class="col-md-4">
                <p><i class="bi bi-cup-straw"></i> Cuisine équipée</p>
                <p><i class="bi bi-car-front"></i> Parking gratuit</p>
            </div>
            <div class="col-md-4">
                <p><i class="bi bi-snow"></i> Climatisation</p>
                <p><i class="bi bi-door-closed"></i> Entrée privée</p>
            </div>
        </div>
    </div>

    <!-- =======================
         AVIS
    ======================= -->
    <div>
        <h2 class="section-heading">Avis</h2>

        <div class="review">
            <p>
                <strong>Jean Dupont</strong> 
                <span class="text-warning"><i class="bi bi-star-fill"></i> 5.0</span>
            </p>
            <p class="mb-0">
                Superbe expérience, l'appartement était propre et bien situé !
            </p>
        </div>
        
        <div class="review">
            <p>
                <strong>Marie Curie</strong> 
                <span class="text-warning"><i class="bi bi-star-fill"></i> 4.5</span>
            </p>
            <p class="mb-0">
                Très bon séjour, mais un peu bruyant la nuit.
            </p>
        </div>
    </div>

</div> <!-- /container -->

<?php
require_once("block/footer.php");
?>
