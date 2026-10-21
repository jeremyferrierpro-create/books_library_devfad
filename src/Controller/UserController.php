<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\UserService;

class UserController extends AbstractController
{
    // Attribut
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register(): mixed
    {
         // 1 & 6. Si l'utilisateur est déjà connecté, le rediriger vers l'accueil immédiatement
        if (isset($_SESSION["user"])) {
            header("Location: /");
            exit;
        }
        $data = [];
        // Tester si le formulaire est soumis
        if (isset($_POST["submit"])) {
            $data["msg"] = $this->userService->insertUser();
        }
        // retourne la vue 
        return $this->render('register', 'Inscription', $data);
    }

    public function login(): mixed
    {
        // 1 & 6. Si l'utilisateur est déjà connecté, le rediriger vers l'accueil immédiatement
        if (isset($_SESSION["user"])) {
            header("Location: /");
            exit;
        }

        // 3. Initialiser $data avec un tableau vide
        $data = [];

        // 4. Si la requête est en POST et que le bouton submit est présent
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
            // Appeler connectUser() et enregistrer le message dans $data["msg"]
            $data["msg"] = $this->userService->connectUser();
        }

        // 5. En sortie, retourner le template de connexion
        return $this->render('login', 'Connexion', $data);
    }

    public function logout(): void {
    session_destroy();
    unset ($_COOKIE["PHPSESSID"]);
    header ("Location: /");
    }
}
