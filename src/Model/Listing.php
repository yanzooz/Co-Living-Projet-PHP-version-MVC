<?php

namespace App\Model;

Use App\Model\User;

class Listing {
    private int|null $id;
    private string $title;
    private string $description;
    private int|null $user_id;
    private string|null $createdAt;
    private string $image;
    private User $owner;

    public function __construct(int|null $id, string $title, string $description, int|null $user_id, string|null $createdAt, string $image, User $owner) {
       $this->id = $id;
       $this->title = $title;
       $this->description = $description;
       $this->user_id = $user_id;
       $this->createdAt = $createdAt;
       $this->image = $image;
       $this->owner = $owner;
    }

    // Getters
    public function getId(): int|null {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getUserListing(): string {
        return $this->user_id;
    }

    public function getDate(): string {
        return $this->createdAt;
    }


    public function getImage(): string {
        return $this->image;
    }

    public function getOwner(): User {
        return $this->owner;
    }

    // Setters
    public function setId(int|null $id): void {
        $this->id = $id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setUserListing(string $user_id): void {
        $this->user_id = $user_id;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function setOwner(User $owner): void{
        $this->owner = $owner;
    }
}
