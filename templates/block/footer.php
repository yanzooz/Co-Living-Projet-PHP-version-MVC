<footer class="bg-dark text-light mt-5 pt-4 pb-3">
        <div class="container">
            <div class="row">
                <!-- 1ère colonne : Navigation rapide -->
                <div class="col-md-4">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.php" class="text-light text-decoration-none">Accueil</a></li>
                        <li><a href="#services" class="text-light text-decoration-none">Nos Services</a></li>
                        <li><a href="#contact" class="text-light text-decoration-none">Contact</a></li>
                        <!-- Lien direct vers la page index -->
                        <?php if(isset($_SESSION["username"])):?>
                        <li class="mt-2">
                            <a href="index.php?action=adminHomePage" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-arrow-left-circle"></i> Retour à l'accueil
                            </a>
                        </li>
                        <?php else:?>
                        <li class="mt-2">
                            <a href="index.php?action=homePage" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-arrow-left-circle"></i> Retour à l'accueil
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>

                <!-- 2ème colonne : Informations -->
                <div class="col-md-4">
                    <h5>Informations</h5>
                    <p class="mb-1">Adresse : 123 Avenue du Web, 75000 Paris</p>
                    <p class="mb-1">Téléphone : +33 1 23 45 67 89</p>
                    <p>Email : <a href="mailto:contact@monsite.com" class="text-light text-decoration-none">contact@monsite.com</a></p>
                </div>

                <!-- 3ème colonne : Réseaux sociaux -->
                <div class="col-md-4">
                    <h5>Suivez-nous</h5>
                    <div class="d-flex align-items-center">
                        <a href="#" class="text-light fs-4 me-3">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="text-light fs-4 me-3">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="text-light fs-4 me-3">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-light fs-4">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                    <p class="mt-3">
                        Rejoignez notre communauté pour découvrir nos dernières offres et services !
                    </p>
                </div>
            </div>

            <!-- Ligne de séparation -->
            <hr class="my-4 bg-secondary">

            <!-- Note de copyright -->
            <div class="text-center">
                <p class="mb-0">&copy; 2025 - MonSiteDeRéservation. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>