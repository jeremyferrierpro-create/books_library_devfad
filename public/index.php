<?php
include '../vendor/autoload.php';

session_start();

// récupération de l'URL (composante)
$url = parse_url($_SERVER["REQUEST_URI"]);

// extraction du path
$path = isset($url["path"]) ? $url["path"] : "/";

// importer les variables d'environnement 
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

// importer les contrôleurs
use App\Controller\HomeController;
use App\Controller\CategoryController;

// instancier les contrôleurs
$homeController = new HomeController();
$categoryController = new CategoryController();

// test des valeurs du path
switch ($path) {
    case '/':
        $homeController->home();
        break;

    case '/register':
        $userController->register();
        break;
    case '/category/new':
        $categoryController->addCategory();
        break;
    case '/categories':
        $categoryController->showAllCategorie();
        break;

    // --- Nouvelles routes pour les catégories ---
    case '/category/new':
        $categoryController->addCategory();
        break;

    case '/categories':
        $categoryController->showCategories();
        break;
    // -------------------------------------------

    default:
        echo "Erreur 404";
        break;
}