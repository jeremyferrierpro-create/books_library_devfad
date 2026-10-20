<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?? "" ?></title>
</head>
<body>
    <h1>Liste des catégories</h1>

    <a href="index.php?page=category/new">Ajouter une catégorie</a>
    <hr>

    <section>
        <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $category): ?>
                <article>
                    <h2>ID : <?= $category->getId() ?></h2>
                    <p>Nom : <?= htmlspecialchars($category->getCategoryName()) ?></p>
                </article>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune catégorie trouvée pour le moment.</p>
        <?php endif; ?>
    </section>
</body>
</html>