<?php

namespace App\Manager;

use App\Model\Listing;
use App\Model\User;

class ListingManager extends DatabaseManager
{
    public function selectAll(): array
    {
        $request = self::getConnexion()->prepare
        ("SELECT a.id, a.titre,a.user_id ,a.description,a.created_at,a.image,
         u.id AS owner_id, u.username AS ownerUsername,u.email AS ownerEmail, u.password, u.role AS ownerRole
        FROM annonces a
        INNER JOIN users u ON a.user_id = u.id;");
        $request->execute();
        $arrayListings = $request->fetchAll();

        $listings = [];
        foreach ($arrayListings as $arrayListing) {
            $owner = new User($arrayListing["owner_id"], $arrayListing["ownerUsername"], $arrayListing["ownerEmail"], $arrayListing["password"], $arrayListing["ownerRole"]);
            $listings[] = new Listing($arrayListing["id"], $arrayListing["titre"], $arrayListing["description"], $arrayListing["user_id"], $arrayListing["created_at"], $arrayListing["image"], $owner);
        }
        return $listings;
    }


    public function selectById(int $id): Listing | false
    {
        $request = self::getConnexion()->prepare("SELECT a.*,
         u.id AS owner_id, u.username AS ownerUsername,u.email AS ownerEmail, u.password, u.role AS ownerRole
         FROM annonces a
         INNER JOIN users u ON a.user_id = u.id
         WHERE a.id = :id;
         ");
        $request->execute([
            ":id" => $id
        ]);
        $arrayListing = $request->fetch();

        if (!$arrayListing) {
            return false;
        }
        $owner = new User($arrayListing["owner_id"], $arrayListing["ownerUsername"], $arrayListing["ownerEmail"], $arrayListing["password"], $arrayListing["ownerRole"]);
        return new Listing($arrayListing["id"], $arrayListing["titre"], $arrayListing["description"], $arrayListing["user_id"], $arrayListing["created_at"], $arrayListing["image"],$owner);
    }


    public function selectOwnerById(int $ownerId): array
    {
        $request = self::getConnexion()->prepare("
        a.*,
         u.id AS owner_id, u.username AS ownerUsername,u.email AS ownerEmail, u.password, u.role AS ownerRole
         FROM annonces a
         INNER JOIN users u ON a.user_id = u.id
         WHERE a.id = :ownerId;
         ");
        $request->execute([
            ":ownerId" => $ownerId
        ]);

        $arrayListings = $request->fetchAll();
        $listings = [];

        foreach ($arrayListings as $arrayListing) {
            $owner = new User($arrayListing["owner_id"], $arrayListing["ownerUsername"], $arrayListing["ownerUsername"], $arrayListing["password"], $arrayListing["ownerRole"]);
            $listings[] = new Listing($arrayListing["id"], $arrayListing["titre"], $arrayListing["description"], $arrayListing["user_id"], $arrayListing["created_at"], $arrayListing["image"], $owner);
        }
        return $listings;
    }

    public function insert(Listing $listing): bool
    {
        $request = self::getConnexion()->prepare("INSERT INTO annonces (titre,description,user_id,image) VALUES(:titre,:description,:user_id,:image)");
        $request->execute([
            ":titre" => $listing->getTitle(),
            ":description" => $listing->getDescription(),
            ":user_id" => $listing->getUserListing(),
            ":image" => $listing->getImage()
        ]);
        return $request->rowCount() > 0;
    }

    public function update(Listing $listing): bool
    {
        $request = self::getConnexion()->prepare("UPDATE annonces SET titre=:titre, description=:description, user_id=:user_id,image =:image WHERE id = :id");
        $request->execute([
            ":titre" => $listing->getTitle(),
            ":description" => $listing->getDescription(),
            ":user_id" => $listing->getUserListing(),
            "image" => $listing->getImage(),
            "id" => $listing->getId(),
        ]);
        return $request->rowCount() > 0;
    }

    public function deleteById(int $id): bool
    {
        $request = self::getConnexion()->prepare("DELETE FROM annonces WHERE id=:id;");
        $request->execute([
            ":id" => $id
        ]);
        return $request->rowCount() > 0;
    }
}
