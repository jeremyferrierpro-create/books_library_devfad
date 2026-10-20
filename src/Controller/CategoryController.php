<?php

namespace App\Controller;

use App\Service\CategoryService;

class CategoryController extends AbstractController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    // Exercice 7 : addCategory
    public function addCategory(): mixed
    {
        $data = [];

        // Test si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // On stocke le message de retour dans le tableau $data['msg']
            $data["msg"] = $this->categoryService->insertCategory();
        }

        // 1er arg : nom du template (sans le préfixe 'template_')
        // 2ème arg : le titre de la page (string)
        // 3ème arg : le tableau de données ($data)
        return $this->render('add_category', 'Ajouter une catégorie', $data);
    }

    // Exercice 8 : showCategories
    public function showCategories(): mixed
    {
        // 5. Appeler la méthode getAllCategories du Service
        $categories = $this->categoryService->getAllCategories();

        // 6. Appeler la render avec le titre en 2ème argument et les données en 3ème
        return $this->render('show_all_categories', 'Liste des catégories', [
            'title' => 'Liste des catégories',
            'categories' => $categories
        ]);
    }
}