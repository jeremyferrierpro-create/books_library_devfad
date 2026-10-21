<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?? "" ?></title>
</head>
<body>
<?php include 'component/navbar.php'; ?>
    <main class="container-fluid">
        <h1>Se connecter</h1>
        <form action="/login" method="post">
            <!-- Champ Email -->
            <div>
                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Champ Mot de passe -->
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Bouton Submit -->
            <div>
                <input type="submit" name="submit" value="Connexion">
            </div>
        </form>

        <!-- 5. Paragraphe pour afficher le message transmis par le contrôleur ($data['msg']) -->
        <p><?= htmlspecialchars ($data["msg"] ?? "", ENT_QUOTES, 'UTF-8') ?></p>
    </main>

</body>
</html>
