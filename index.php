
<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controller\IndexController;
use App\Controller\AdminController;
use App\Controller\SecurityController;
use App\Manager\UserManager;

// Démarrer la session et vérification de la connexion user 
session_start();
$isLoggedIn = false;
$user = null;
if (isset($_SESSION["username"])) {
    $userManager = new UserManager();
    $user = $userManager->selectByUsername($_SESSION["username"]);
    if ($user) {
        $isLoggedIn = true;
    }
}

// Récupérer les paramètres de l'URL et créer des valeurs par défaut
if (isset($_GET['action'])) {

    $action = $_GET['action'];
} else {

    $action = 'homePage';
}

// Récupérer les paramètres de l'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = null;
}

//Initialisation des controllers
$adminController = new AdminController();
$indexController = new IndexController();
$securityController = new SecurityController();

//index.php?action=homePage
if ($action === 'homePage') {
    $indexController->homePage();

//index.php?action=login
} elseif ($action === 'login') {
    $securityController->login();
}
//index.php?action=register
elseif ($action === 'register') {
    $securityController->register();
}
//index.php?action=adminHomePage
elseif ( $action === 'adminHomePage' && $isLoggedIn) {
    $indexController->adminHomePage();
}
//index.php?action=logout
elseif ( $action === 'logout' && $isLoggedIn) {
    $securityController->logout();
}
//index.php?action=dashboard
elseif ( $action === 'dashboard' && $isLoggedIn) {
    $adminController->dashboardAdmin();
}
//index.php?action=adminCreate
elseif ( $action === 'adminCreate' && $isLoggedIn) {
    $adminController->addListing($user);
}
//index.php?action=adminEdit&id
elseif ( $action === 'adminEdit' && !is_null($id) && $isLoggedIn ) {
    $adminController->editListing($id,$user);
}
// index.php?action=adminDelete&id
elseif ( $action === 'adminDelete' && !is_null($id) && $isLoggedIn) {
    $adminController->deleteListing($id,$user);
}
elseif ( $action === 'detailListing' && !is_null($id)) {
    $adminController->detailListing($id);
}
elseif ( $action === 'reserveListing' && !is_null($id) && $isLoggedIn) {
    $adminController->reserveListing($id);
}

//index.php?action=login


?>




<?php
