<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>



<?php if (isset($errors["email"])): ?>
    <div class="alert alert-danger"><?= $errors["email"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["emptyEmail"])): ?>
    <div class="alert alert-danger"><?= $errors["emptyEmail"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["existEmail"])): ?>
    <div class="alert alert-danger"><?= $errors["existEmail"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["existUsername"])): ?>
    <div class="alert alert-danger"><?= $errors["existUsername"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["strlenUsername"])): ?>
    <div class="alert alert-danger"><?= $errors["strlenUsername"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["strlenPassword"])): ?>
    <div class="alert alert-danger"><?= $errors["strlenPassword"];
                                    ?></div>
<?php endif; ?>

<?php if (isset($errors["role"])): ?>
    <div class="alert alert-danger"><?= $errors["role"];
                                    ?></div>
<?php endif; ?>


<nav class="navbar bg-secondary text-white mb-4">
    <form class="container-fluid justify-content-end hstack gap-3" method="post">
        <h2 class="p-2">REGISTER</h2>
        <button type="submit" class="btn btn-outline-light me-2 p-2 ms-auto" name="toLogin">Se connecter</button>
        <button type="button" class="btn btn-dark p-2 disabled">S'inscrire</button>
    </form>
</nav>

<body class="ms-4 mt-4 me-4 bg-dark-subtle text-dark-emphasis">
    <h2 class="mb-3 mt-4">Créer un compte</h2>
    <form class="row g-3 needs-validation" novalidate method="post">
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <div class="input-group has-validation ">
                <span class="input-group-text">@</span>
                <input type="email " value="<?= $_POST["email"] ?? "" ?>" class="form-control 
                    <?= ($_SERVER["REQUEST_METHOD"] == "POST") ? (isset($errors["existEmail"]) | isset($errors["emptyEmail"]) ? "is-invalid" : "is-valid") : "" ?>"
                    id="email" name="email" required>
                <div class="invalid-feedback">
                    Veuillez entrer une adresse email valide.
                </div>
                <div class="valid-feedback">
                    C'est bon !
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" value="<?= $_POST["username"] ?? "" ?> " class="form-control 
                                                        <?= ($_SERVER["REQUEST_METHOD"] == "POST") ? ((isset($errors["existUsername"]) | isset($errors["strlenUsername"])) ? "is-invalid" : "is-valid") : "" ?>" id="username" name="username" required>
            <div class="invalid-feedback">
                Veuillez entrer un nom d'utilisateur valide.
            </div>
            <div class="valid-feedback ">
                C'est bon !
            </div>
        </div>
        <div class="col-md-4">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control
                 <?= ($_SERVER["REQUEST_METHOD"] == "POST") ? (isset($errors["strlenPassword"]) ? "is-invalid" : "is-valid") : "" ?>"
                id="password" name="password" required>
            <div class="invalid-feedback">
                Veuillez entrer un mot de passe valide.
            </div>
            <div class="valid-feedback">
                C'est bon !
            </div>

        </div>
        <div class="col-md-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-select <?= isset($errors["role"]) ? "is-invalid" : "" ?>" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="invite">Invité</option>
            </select>
            <div class="invalid-feedback">
                Veuillez choisir un rôle.
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="terms" required>
                <label class="form-check-label" for="terms">
                    Accepter les termes et conditions
                </label>
                <div class="invalid-feedback">
                    Vous devez accepter les termes avant de soumettre.
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-dark" type="submit">S'inscrire</button>
        </div>
    </form>
    </div>
</body>
<?php require_once("block/footer.php"); ?>