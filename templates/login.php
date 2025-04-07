<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>


<body class="ms-4 mt-4 me-4 bg-dark-subtle text-dark-emphasis">
    <nav class="navbar bg-secondary text-white mb-4">
        <form class="container-fluid justify-content-end hstack gap-3" method="post">
            <h2 class="p-2">LOGIN</h2>
            <button type="button" class="btn btn-outline-light me-2 disabled p-2 ms-auto">Se connecter</button>
            <button type="submit" class="btn btn-dark p-2" name="toRegister">S'inscrire</button>
        </form>
    </nav>

    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control <?= isset($errors["username"]) || isset($errors["login"]) ? "is-invalid" : "" ?>" id="exampleInputEmail1" name="username">
            <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control <?= isset($errors["username"])||isset($errors["login"]) ? "is-invalid" : "" ?>" id="exampleInputPassword1" name="password">
        </div>
        <?php if (isset($errors["username"])): ?>
            <div class="alert alert-danger"> <?= $errors["username"] ?> </div>
        <?php endif ?>
        <?php if (isset($errors["login"])): ?>
            <div class="alert alert-danger"> <?= $errors["login"] ?> </div>
        <?php endif ?>


        <button type="submit" class="btn btn-dark">Submit</button>
    </form>
</body>
<?php require_once("block/footer.php")?>