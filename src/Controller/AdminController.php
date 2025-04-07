<?php

namespace App\Controller;

use App\Manager\ListingManager;
use App\Model\Listing;
use App\Model\User;
use App\Service\FileUploader;
use Symfony\Component\VarDumper\VarDumper;

class AdminController
{
    private ListingManager $listingManager;

    public function __construct()
    {
        $this->listingManager = new ListingManager();
    }

    public function isGranted(string $role)
    {
        if (!isset($_SESSION["username"]) || $_SESSION["role"] !== $role) {
            $_SESSION["message"] = "🚨 ALERTE : ACCÈS REFUSÉ, compte ⇒ ". $_SESSION["role"] . " NON-AUTORISE";
            header("Location: index.php?action=adminHomePage");
            exit();
        }
    }

    public function dashboardAdmin()
    {
        //Vérifie si le user est admin
        $this->isGranted("admin");
        $titleDisplay = "ADMIN DASHBOARD";
        $listings = $this->listingManager->selectAll();
        require_once("./templates/dashboard.php");
    }

    public function addListing(User $user)
    {
        $this->isGranted("admin");
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = $this->validateListingForm($errors, $_POST);
            $fileUploader = new FileUploader();
            $fileUploadResult = [];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $fileUploadResult = $fileUploader->upload($_FILES['image']); // Appel du service d'upload
            } else {
                $errors["file"] = "L'image est manquante";
            }

            // Si le résultat est un tableau d'erreurs, on les fusionne avec les autres erreurs
            if (is_array($fileUploadResult)) {
                $errors = array_merge($errors, $fileUploadResult);
            }

            if (empty($errors)) {
                $listing = new Listing(null, $_POST["titre"], $_POST["description"], intval($_SESSION["user_id"]), null, $fileUploadResult, $user);
                $listingManager = new ListingManager();
                $listingManager->insert($listing);
                header("Location: index.php?action=dashboard");
                exit();
            }
        }
        require_once("./templates/listing_create.php");
        echo ("ajouter");
    }

    public function editListing(int $id, User $user)
    {
        $listing = $this->listingManager->selectById($id);
        if (!$listing || $listing->getOwner()->getId() !== $user->getId()) {
            header("Location: index.php?action=dashboard");
            $_SESSION["message"] = "une erreur est survenu vous n'etes pas propriétaire de l'annonce";
            exit();
        }

        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = $this->validateListingForm($errors, $_POST);
            var_dump($_POST);
            if (empty($errors) && !empty($_FILES['image']['name'])) {
                $fileUploader = new FileUploader();
                $fileUploadResult = [];

                if ($_FILES['image']['error'] == 0) {
                    $fileUploadResult = $fileUploader->upload($_FILES['image']); // Appel du service d'upload
                    // Si le résultat est un tableau d'erreurs, on les fusionne avec les autres erreurs
                    if (is_array($fileUploadResult)) {
                        $errors = $fileUploadResult;
                    } else {
                        $fileUploader->delete($listing->getImage());
                        $listing->setImage($fileUploadResult);
                    }
                } else {
                    $errors["image"] = "L'image est manquante";
                }
            }
            if (empty($errors)) {
                $listing->setTitle($_POST["titre"]);
                $listing->setDescription($_POST["description"]);
                $this->listingManager->update($listing);
                $_SESSION["succes"] = "ANNONCE MODIFIE AVEC SUCCES";
                header("Location: index.php?action=dashboard");
                exit();
            }
        }
        require_once("./templates/listing_edit.php");
        echo ("modifier");
    }

    public function deleteListing(int $id, User $user)
    {
        $this->isGranted("admin");

        // Récupérer l'annonce par son ID
        $listing = $this->listingManager->selectById($id);

        // Vérifier si l'annonce existe
        if (!$listing) {
            $_SESSION["message"] = "L'annonce n'existe pas.";
            header("Location: index.php?action=dashboard");
            exit();
        }

        // Vérifier si l'utilisateur est le propriétaire de l'annonce
        if ($listing->getOwner()->getId() !== $user->getId()) {
            $_SESSION["message"] = "Vous n'êtes pas autorisé à supprimer cette annonce.";
            header("Location: index.php?action=dashboard");
            exit();
        }

        // Si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Supprimer l'image associée à l'annonce
            $fileUploader = new FileUploader();
            $fileUploader->delete($listing->getImage());

            // Supprimer l'annonce de la base de données
            $this->listingManager->deleteById($id);

            $_SESSION["succes"] = "Annonce supprimée avec succès.";
            header("Location: index.php?action=dashboard");
            exit();
        }

        // Charger la vue de confirmation de suppression
        require_once("./templates/listing_delete.php");
    }

    public function validateListingForm(array $errors, array $listingForm): array
    {
        if (empty($listingForm["titre"]) || (strlen($listingForm["description"]) < 10) || (strlen($listingForm["titre"])) < 10) {
            $errors["strlenAnnonce"] = "Votre titre ou description doit contenir au moins 10 caractères";
        }
        return $errors;
    }


    public function detailListing(int $id)
    {
        // Vérifie si le user est invité
        if($this->isGranted("invite")){
            $_SESSION["message"] = "Vous devez être connecté en tant qu'invité pour voir les détails de l'annonce.";
        }

        $listing = $this->listingManager->selectById($id);
        $titleDisplay = "DETAILS DE L'ANNONCE";

        if (!$listing) {
            $_SESSION["message"] = "L'annonce demandée n'existe pas.";
            header("Location: index.php?action=homePage");
            exit();
        }

        require_once("./templates/listing_detail.php");
    }



    public function reserveListing(int $id)
    {
        if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "invite") {
            $_SESSION["message"] = "Vous devez être connecté en tant qu'invité pour réserver une annonce.";
            header("Location: index.php?action=login");
            exit();
        }

        $listing = $this->listingManager->selectById($id);

        if (!$listing) {
            $_SESSION["message"] = "L'annonce demandée n'existe pas.";
            header("Location: index.php?action=homePage");
            exit();
        }

        // Logique de réservation (par exemple, ajouter une entrée dans une table `reservations`)
        $_SESSION["succes"] = "Vous avez réservé l'annonce avec succès.";
        header("Location: index.php?action=detailListing&id=" . $id);
        exit();
    }
}
