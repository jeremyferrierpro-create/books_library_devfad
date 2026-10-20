<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
</head>
<body>
    <h1>Ajouter une nouvelle catégorie</h1>

    <!-- Formulaire en POST -->
    <form action="" method="POST">
        <div>
            <label for="category_name">Nom de la catégorie :</label>
            <input type="text" id="category_name" name="category_name" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Ajouter">
        </div>
    </form>

    <!-- Paragraphe pour afficher le message de succès ou d'erreur -->
    <p><?= $data["msg"] ?? "" ?></p>

    <br>
    <a href="index.php?page=categories">Voir toutes les catégories</a>
</body>
</html>
