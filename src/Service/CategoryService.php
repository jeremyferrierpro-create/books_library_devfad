<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    // 3. Attribut privé pour le repository
    private CategoryRepository $categoryRepository;

    // 4. Constructeur : instanciation de CategoryRepository
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    // 5. Méthode pour récupérer toutes les catégories
    public function getAllCategories(): array
    {
        
        return $this->categoryRepository->findAll();
    }

    // 6. insertCategory
    public function insertCategory(): string
    {
        // 1. Tester si le champ category_name est soumis et non vide
        if (empty($_POST['category_name'])) {
            return "Veuillez remplir le nom de categorie";
        }

        $categoryName = trim($_POST['category_name']);

        // 2. Vérifier si la catégorie existe déjà en BDD grâce à findByName
        $existingCategory = $this->categoryRepository->findByName($categoryName);
        if ($existingCategory) {
            return "La categorie : " . $categoryName . " existe déjà";
        }

        // 3. Créer un nouvel objet Category et setter son nom
        $category = new \App\Entity\Category();
        $category->setCategoryName($categoryName);

        // 4. Ajouter la catégorie en BDD avec la méthode create() du repository
        $result = $this->categoryRepository->create($category);

        if ($result) {
            return "La catégorie : " . $categoryName . " a été ajouté avec success.";
        }

        return "Erreur lors de l'ajout de la catégorie.";
    }
}
