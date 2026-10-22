<nav class="container-fluid">
  <ul>
    <li><strong>Books Library</strong></li>
  </ul>
  <ul>
    <li><a href="/">Accueil</a></li>
    <li><a href="/categories">Liste des catégories</a></li>
    <li><a href="/category/new">Ajouter une catégorie</a></li>

    <!-- Visible uniquement si l'utilisateur est ADMIN -->
    <?php if (isset($_SESSION["user"]) && ($_SESSION["user"]["grant"] ?? '') === 'ROLE_ADMIN'): ?>
      <li><a href="/book/new">Ajouter un livre</a></li>
    <?php endif; ?>

    <?php if (isset($_SESSION["user"])): ?>
      <li><span>Bonjour, <?= htmlspecialchars($_SESSION["user"]["firstname"]) ?></span></li>
      <li><a href="/logout">Deconnexion</a></li>
    <?php else: ?>
      <li><a href="/register">Inscription</a></li>
      <li><a href="/login">Connexion</a></li>
    <?php endif; ?>
  </ul>
</nav>