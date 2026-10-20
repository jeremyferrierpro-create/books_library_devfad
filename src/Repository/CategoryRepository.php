<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Category;

class CategoryRepository
{
    private \PDO $connexion;

    public function __construct()
    {
        $this->connexion = Mysql::connectBdd();
    }

    // create
    public function create(Category $category): ?Category
    {
        try {
            $sql = "INSERT INTO `category` (`category_name`) VALUES (?)"; //je créer la requête
            $stmt =$this->connexion->prepare($sql); // Je la prépare
            $stmt->bindValue(1, $category->getCategoryName(), \PDO::PARAM_STR); //J'assigne la valeur
            $stmt->execute(); //J'exécute la requête

            $id = (int)$this->connexion->lastInsertId();
            $category->setId($id);

            return $category;
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la catégorie : " . $e->getMessage();
            return null;
        }
    }

    // Exercice 2 : findByName
    public function findByName(string $name): ?Category
    {
        try {
            $sql = "SELECT c.id_category, c.category_name 
                    FROM `category` AS c 
                    WHERE c.category_name = ?";

            $stmt =$this->connexion->prepare($sql);
            $stmt->bindValue(1, $name, \PDO::PARAM_STR);
            $stmt->execute();

            $data =$stmt->fetch(\PDO::FETCH_ASSOC);

            if ($data) {
                return Category::hydrate($data);
            }
        } catch (\PDOException $e) {
            echo "Erreur lors de la recherche de la catégorie : " . $e->getMessage();
        }

        return null;
    }

    // Exercice 4 : findAll
    public function findAll(): array
    {
        $categories = [];

        try {
            // 1. Écrire la requête SELECT
            $sql = "SELECT c.id_category, c.category_name FROM `category` AS c";

            // 2. Préparer la requête
            $stmt = $this->connexion->prepare($sql);

            // 3. Exécuter la requête
            $stmt->execute();

            // 4. Récupérer le résultat avec fetchAll
            $datas =$stmt->fetchAll(\PDO::FETCH_ASSOC);

            // 5. Hydrater chaque tableau associatif en objet Category
            if ($datas) {
                foreach ($datas as$data) {
                    $categories[] = Category::hydrate($data);
                }
            }
        } catch (\PDOException $e) {
            echo "Erreur lors de la récupération des catégories : " . $e->getMessage();
        }

        // 6. Retourner le tableau d'objets (ou vide si rien n'est trouvé)
        return $categories;
    }
}