<?php

namespace App\Controller;

use App\Manager\UserManager;
use App\Model\User;

class SecurityController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    // Route URL -> index.php?action=admin
    public function login()
    {
        if (isset($_POST['toRegister'])) {
            header("Location: index.php?action=register");
            exit();
        }
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if (empty($username) || strlen($username) < 5) {
                $errors['username'] = 'Votre username ou password est vide ou incohérant';
            }
            if (empty($password) || strlen($password) < 5) {
                $errors['username'] = 'Votre username ou password est vide ou incohérant';
            }

            if (count($errors) == 0) {
                $user = $this->userManager->selectByUsername($username);
                if ($user != false) {
                    if (password_verify($password, $user->getPassword())) {
                        $_SESSION["username"] = $user->getUsername();
                        $_SESSION["user_id"] = $user->getId();
                        $_SESSION["role"] = $user->getRole();
                        header("Location: index.php?action=adminHomePage");
                        exit();
                    }
                }
                $errors["login"] = 'Identifiants ou mot de passe incorrecte';
            }
        }
        require_once("./templates/login.php");
    }

    public function register()
    {   
        if (isset($_POST['toLogin'])) {
            header("Location: index.php?action=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = [];
            $username = htmlspecialchars(trim($_POST["username"]));
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $role = $_POST["role"]; // 'admin' ou 'invite'
            // Vérifier si le rôle est valide
            if (!in_array($role, ['admin', 'invite'])) {
                $errors["role"] = "Une erreur est survenue lors du choix de votre role ";
            }
            if (empty($email)) {
                $errors["emptyEmail"] = "Champs vide";
            }
            // Vérifier si l'email est valide
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Adresse email invalide.";
            }
            // Verifier si l'utilisateur et le mot de passe sont comforme 
            if (empty($username) | strlen($username) < 5) {
                $errors["strlenUsername"] = "Votre nom d'utilisateur doit contenir au moins 5 caractères";
            }
            if (empty($_POST["password"]) | strlen($_POST["password"]) < 5) {
                $errors["strlenPassword"] = "Votre mot de passe doit contenir au moins 5 caractères";
            }
            // Vérifier si l'utilisateur ou l'email existe déja !
            if (empty($errors)) {
                $usernameExist = $this->userManager->selectByUsername($username);
                $emailExist= $this->userManager->selectByEmail($email);
                if ($usernameExist) {
                    var_dump($usernameExist);
                    $errors["existUsername"] = "Cet username existe déja !";
                }
                if ($emailExist) {
                    var_dump($emailExist);
                    $errors["existEmail"] = "Cet email est déjà utilisé.";
                }
                // Instancie les données de l'utilisateur par la class User 
                if (empty($errors)) {
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

                    $user = new User(null,$username, $email, $password, $role);
                    $this->userManager->insert($user);
                    $_SESSION["username"] = $user->getUsername();
                    $indexController = new IndexController();
                    $indexController->homePage();
                    exit();
                }
            }
        }
        require_once("./templates/register.php");
    }

    public function logout()
    {
        unset($_SESSION["username"]);
        unset($_SESSION["role"]);
        $indexController = new IndexController();
        $indexController->homePage();
    }
}
?>






