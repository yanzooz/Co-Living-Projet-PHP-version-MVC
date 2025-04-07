<?php
require_once("block/header/dashboard_header.php");
?>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="mb-4">Ajouter une annonce</h2>

            <!-- Affichage des erreurs principales (si vous souhaitez les regrouper) -->
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Formulaire -->
            <form action="index.php?action=adminCreate" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="bg-white p-4 shadow-sm rounded"
            >
                <!-- Titre de l'annonce -->
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre de l'annonce</label>
                    <input 
                        type="text" 
                        name="titre" 
                        id="titre" 
                        class="form-control <?= isset($errors['strlenAnnonce']) ? 'is-invalid' : '' ?>" 
                        value="<?= isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : '' ?>"
                        required
                    >
                    <div class="invalid-feedback">
                        Veuillez choisir un titre d'annonce valide.
                    </div>
                </div>

                <!-- Description de l'annonce -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        class="form-control <?= isset($errors['strlenAnnonce']) ? 'is-invalid' : '' ?>" 
                        required
                    ><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                    <div class="invalid-feedback">
                        Veuillez saisir une description.
                    </div>
                </div>

                <!-- Image de l'annonce -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        class="form-control <?= isset($errors['file']) || isset($errors['typeFiles']) || isset($errors['sizeFiles']) ? 'is-invalid' : '' ?>" 
                        required
                    >
                    <div class="invalid-feedback">
                        Veuillez choisir une image valide.
                    </div>
                </div>

                <!-- Boutons d'action -->
                <button type="submit" class="btn btn-primary">
                    Ajouter l'annonce
                </button>
                <a href="index.php?action=dashboard" class="btn btn-secondary">
                    Retour
                </a>
            </form>
        </div>
    </div>
</div>

<?php require_once("block/footer.php"); ?>
</body>
</html>
