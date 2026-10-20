<?php

namespace App\Entity;

class Category
{
    private ?int $id = null;
    private ?string $categoryName = null;

    // --- HYDRATEUR ---
    public static function hydrate(array $data): self
    {
        $category = new self();
        
        if (isset($data['id_category'])) {
            $category->setId((int) $data['id_category']);
        }
        
        if (isset($data['category_name'])) {
            $category->setCategoryName($data['category_name']);
        }

        return $category;
    }

    // --- GETTERS & SETTERS ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(?string $categoryName): self
    {
        $this->categoryName = $categoryName;
        return $this;
    }
}