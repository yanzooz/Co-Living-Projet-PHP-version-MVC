<!-- ===========================
     NAVBAR
=========================== -->
<?php require_once("block/header/dashboard_header.php"); ?>
<style>
    .sidebar {
        background-color: #f8f9fa;
    }

    .sidebar h4 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .sidebar p {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .sidebar .nav-link {
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }

    .sidebar .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .sidebar .nav-link:hover {
        background-color: #e9ecef;
    }

    /* Style pour la description dans le tableau */
    .table tbody tr td span {
        cursor: pointer;
        text-decoration: underline;
        color: black;
        /* Couleur principale */
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    .table tbody tr td span:hover {
        color: var(--primary-hover);
        /* Couleur au survol */
        text-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Légère lueur au survol */
        font-weight: 500;
        /* Met en gras au survol */
    }
</style>

<!-- ===========================
     DASHBOARD ADMIN
=========================== -->
<div class="container-fluid">
    <div class="row">
        <!-- ===========================
             SIDEBAR
        ============================ -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar py-3">
            <div class="position-sticky">
                <h4 class="text-center"><?= htmlspecialchars($_SESSION["username"]); ?></h4>
                <p class="text-center text-muted">Administrateur</p>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a
                            class="nav-link active d-flex align-items-center gap-2"
                            href="index.php?action=dashboard">
                            <i class="bi bi-speedometer2"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link d-flex align-items-center gap-2"
                            href="index.php?action=adminCreate">
                            <i class="bi bi-plus-circle"></i>
                            Ajouter une annonce
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link text-danger d-flex align-items-center gap-2"
                            href="index.php?action=logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ===========================
             CONTENU PRINCIPAL
        ============================ -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <h2>Tableau de bord</h2>
            <p class="text-muted">
                Bienvenue, <?= htmlspecialchars($_SESSION["username"]); ?>.
            </p>

            <!-- MESSAGE D'ALERTE [DANGER] -->
            <?php if (isset($_SESSION["message"])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION["message"]); ?>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fermer"></button>
                </div>
                <?php unset($_SESSION["message"]); ?>
            <?php endif; ?>

            <!-- MESSAGE D'ALERTE [SUCCES] -->
            <?php if (isset($_SESSION["succes"])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION["succes"]); ?>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fermer"></button>
                </div>
                <?php unset($_SESSION["succes"]); ?>
            <?php endif; ?>

            <!-- BOUTON AJOUTER UNE ANNONCE -->
            <div class="d-flex justify-content-end mb-3">
                <a href="index.php?action=adminCreate" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter une annonce
                </a>
            </div>

            <!-- TABLEAU DES ANNONCES -->
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Créé par</th>
                            <th>Date de création</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listings as $listing): ?>
                            <tr>
                                <td><?= $listing->getId(); ?></td>
                                <td><?= htmlspecialchars($listing->getTitle()); ?></td>
                                <td>
                                    <?php
                                    // Récupérer la description depuis l'objet Listing
                                    $description = $listing->getDescription();

                                    // Choisir la limite de caractères
                                    $maxChars = 50;

                                    // Générer la description tronquée
                                    if (mb_strlen($description) > $maxChars) {
                                        $truncatedDescription = mb_substr($description, 0, $maxChars) . '...';
                                    } else {
                                        $truncatedDescription = $description;
                                    }
                                    ?>

                                    <!-- Affichage du texte tronqué + clic pour ouvrir le modal -->
                                    <span
                                        style="cursor: pointer; text-decoration: underline;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#descModal<?= $listing->getId(); ?>">
                                        <?= htmlspecialchars($truncatedDescription); ?>
                                    </span>

                                    <!-- Modal Bootstrap pour la description complète -->
                                    <div
                                        class="modal fade"
                                        id="descModal<?= $listing->getId(); ?>"
                                        tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Description complète</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <!-- Body -->
                                                <div class="modal-body">
                                                    <?= nl2br(htmlspecialchars($description)); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($listing->getOwner()->getUsername()); ?></td>
                                <td><?= $listing->getDate(); ?></td>
                                <td>
                                    <img
                                        src="./images/<?= htmlspecialchars($listing->getImage()); ?>"
                                        alt="Visuel de l'annonce"
                                        width="100"
                                        class=""
                                        style="cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#imageModal<?= $listing->getId(); ?>">

                                    <!-- Modal Bootstrap -->
                                    <div class="modal fade" id="imageModal<?= $listing->getId(); ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Aperçu de l'image</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img
                                                        src="./images/<?= htmlspecialchars($listing->getImage()); ?>"
                                                        alt="Visuel de l'annonce en grand"
                                                        class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a
                                        href="index.php?action=adminEdit&id=<?= $listing->getId(); ?>"
                                        class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <a
                                        href="index.php?action=adminDelete&id=<?= $listing->getId(); ?>"
                                        class="btn btn-sm btn-danger mb-1">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php require_once("block/footer.php"); ?>
</body>

</html>