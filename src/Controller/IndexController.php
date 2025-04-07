<?php

namespace App\Controller;

use App\Manager\ListingManager;

class IndexController
{
    private ListingManager $listingManager;

    public function __construct()
    {
        $this->listingManager = new ListingManager();
    }

    public function homePage()
    {
        $titleDisplay= "CO-LIVING SITE";
        $listings = $this->listingManager->selectAll();
        require_once("./templates/index_listing.php");
    }

    public function adminHomePage()
    {
        $titleDisplay= "BIENVENUE  ".$_SESSION["username"];
        $listings = $this->listingManager->selectAll();
        require_once("./templates/admin_index_listing.php");
    }
    
}
