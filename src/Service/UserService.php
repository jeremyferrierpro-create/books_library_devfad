<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\Tools;

class UserService
{
    //Attribut
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function insertUser(): string 
    {
        //Tester si les champs obligatoire sont vides
        if (
            empty($_POST["firstname"]) ||
            empty($_POST["lastname"]) ||
            empty($_POST["email"]) ||
            empty($_POST["password"]) ||
            empty($_POST["confirm-password"])
        ) {
            return "Veuillez remplir tous les champs du formulaire";
        }

        //Nettoyer les données
        Tools::sanitizeArray($_POST);

        //Tests Si email est non valide
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            return "L'email : " . $_POST["email"] . " est invalide";
        }
        
        //Tests si les 2 mot de sont différents
        if ($_POST["password"] != $_POST["confirm-password"]) {
            return "Les mots de passe ne sont pas identiques";
        }

        //Test si le mot de passe est plus petit que 8 caractères
        if (strlen($_POST["password"]) < 8) {
            return "Le mot de passe est trop court il faut 8 caractères au minimum";
        }

        //récupérer le compte
        $user = $this->userRepository->findByEmail($_POST["email"]);

        //Tester si le compte existe
        if($user) {
            return "Le compte existe déja";
        }

        //Hasher le mot de passe
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        //hydrater l'objet User
        $newUser = User::hydrate($_POST);

        //Setter le mot de passe hashé
        $newUser->setPassword($hash);

        //Ajouter en BDD le compte
        $this->userRepository->create($newUser);

        return "Le compte " . $_POST["email"] . " a été ajouté en BDD";
    }

    public function connectUser(): string
    {
        // 3. Vérifier que email et password sont présents dans $_POST et sont des chaînes
        if (
            !isset($_POST["email"]) || !is_string($_POST["email"]) ||
            !isset($_POST["password"]) || !is_string($_POST["password"])
        ) {
            return "Veuillez remplir tous les champs du formulaire";
        }

        // 4 & 5. Récupérer l'email (avec trim) et le mot de passe (sans transformation)
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        // 6. Si l'email ou le mot de passe est vide après trim
        if (empty($email) || empty($password)) {
            return "Veuillez remplir tous les champs du formulaire";
        }

        // 7. Vérifier le format de l'email avec filter_var
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Le format de l’email est invalide";
        }

        // 8. Appeler findByEmail() de UserRepository
        $user = $this->userRepository->findByEmail($email);

        // 9. Si aucun compte ne correspond
        if (!$user) {
            return "Les informations sont incorrectes";
        }

        // 10 & 11. Vérifier le mot de passe avec password_verify()
        if (!password_verify($password, $user->getPassword())) {
            return "Les informations sont incorrectes";
        }

        // 12. Si les identifiants sont corrects :
        // - renouveler l'identifiant de session
        session_regenerate_id(true);

        // - enregistrer dans $_SESSION["user"] un tableau avec les infos de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user->getId(),
            "firstname" => $user->getFirstname(),
            "lastname" => $user->getLastname(),
            "email" => $user->getEmail(),
            "grant" => $user->getGrant()
        ];

        return "Connexion réussie";
    }
}
