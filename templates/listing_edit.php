<?php
require_once("block/header/dashboard_header.php");
?>

<body class="bg-light">

<!-- Affichage des erreurs --> 
<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $errorKey => $errorMsg): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($errorMsg); ?>
            <button 
                type="button" 
                class="btn-close" 
                data-bs-dismiss="alert" 
                aria-label="Fermer"
            ></button>
        </div>
    <?php endforeach; ?>
    <?php // Optionnel: vous pourriez vider $errors ici si vous le souhaitez. ?>
<?php endif; ?>

<div class="container mt-5">
    <h2 class="mb-4">Modifier l'annonce</h2>
    
    <!-- Formulaire -->
    <form 
        action="index.php?action=adminEdit&id=<?= $listing->getId(); ?>" 
        method="POST" 
        enctype="multipart/form-data" 
        class="bg-white p-4 shadow-sm rounded"
    >
        <!-- Champ Titre -->
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'annonce</label>
            <input 
                type="text" 
                name="titre" 
                id="titre" 
                class="form-control <?= isset($errors['strlenAnnonce']) ? 'is-invalid' : '' ?>" 
                value="<?= htmlspecialchars($listing->getTitle()); ?>" 
                required
            >
            <div class="invalid-feedback">
                Veuillez choisir un titre d’annonce correct.
            </div>
        </div>

        <!-- Champ Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control <?= isset($errors['strlenAnnonce']) ? 'is-invalid' : '' ?>" 
                rows="4" 
                required
            ><?= htmlspecialchars($listing->getDescription()); ?></textarea>
            <div class="invalid-feedback">
                Veuillez saisir une description.
            </div>
        </div>

        <!-- Image actuelle (si existante) -->
        <div class="mb-3">
            <label class="form-label">Image actuelle</label>
            <div>
                <?php if ($listing->getImage()): ?>
                    <img 
                        src="./images/<?= htmlspecialchars($listing->getImage()); ?>" 
                        alt="Image de l'annonce" 
                        width="350" 
                        class="img-thumbnail"
                    >
                <?php else: ?>
                    <p>Aucune image</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Champ Nouvellement chargée -->
        <div class="mb-3">
            <label for="image" class="form-label">Nouvelle image (facultatif)</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
            >
            <div class="invalid-feedback">
                Veuillez choisir un fichier valide.
            </div>
        </div>

        <!-- Boutons d'action -->
        <button type="submit" class="btn btn-primary">
            Enregistrer les modifications
        </button>
        <a href="index.php?action=dashboard" class="btn btn-secondary">
            Retour
        </a>
    </form>
</div>

<?php require_once("block/footer.php"); ?>
</body>
</html>
